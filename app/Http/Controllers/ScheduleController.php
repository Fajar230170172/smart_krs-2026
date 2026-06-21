<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::where('user_id', Auth::id())
            ->orderByRaw("FIELD(day,'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu')")
            ->get();
        return view('dashboard', compact('schedules'));
    }

    public function destroy($id)
        {
            // Mencari jadwal berdasarkan ID milik user aktif
            $schedule = Schedule::where('user_id', Auth::id())->findOrFail($id);
        
            // Eksekusi hapus data
            $schedule->delete();

            // Kembali dengan notifikasi sukses
            return redirect()->back()->with('success', 'Mata kuliah berhasil dihapus.');
        }

    public function upload(Request $request)
    {
        set_time_limit(300);

        $request->validate([
            'krs_file' => 'required|file|mimes:pdf|max:20480',
        ]);

        $file     = $request->file('krs_file');
        $path     = $file->store('krs', 'local');
        $fullPath = Storage::disk('local')->path($path);

        // Konversi PDF ke JPG via GhostScript
        $imagePath = $this->convertPdfToJpg($fullPath);
        Storage::disk('local')->delete($path);

        if (!$imagePath) {
            return redirect('/dashboard')
                ->with('error', 'Gagal mengkonversi PDF ke gambar. Pastikan GhostScript terinstall.');
        }

        // Kirim JPG ke Gemini Vision
        $scheduleData = $this->parseImageViaVision($imagePath);

        if (file_exists($imagePath)) @unlink($imagePath);

        if (empty($scheduleData)) {
            return redirect('/dashboard')
                ->with('error', 'Tidak ada jadwal yang berhasil dibaca dari KRS.');
        }

        Schedule::where('user_id', Auth::id())->delete();

        $saved     = 0;
        $validDays = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

        foreach ($scheduleData as $item) {
            if (empty($item['course']) || empty($item['day']) || empty($item['start_time'])) continue;

            $day = ucfirst(mb_strtolower(trim($item['day']), 'UTF-8'));
            if (!in_array($day, $validDays)) continue;

            $startTime = $this->normalizeTime($item['start_time']);
            $endTime   = $this->normalizeTime($item['end_time'] ?? $item['start_time']);
            if (!$startTime) continue;
            if (!$endTime)   $endTime = $startTime;

            Schedule::create([
                'user_id'    => Auth::id(),
                'course'     => mb_strtoupper(trim($item['course']), 'UTF-8'),
                'class'      => !empty($item['class']) ? mb_strtoupper(trim($item['class']), 'UTF-8') : null,
                'day'        => $day,
                'start_time' => $startTime,
                'end_time'   => $endTime,
                'room'       => mb_strtoupper(trim($item['room'] ?? 'R. KELAS'), 'UTF-8'),
            ]);
            $saved++;
        }

        if ($saved === 0) {
            return redirect('/dashboard')->with('error', 'KRS terbaca tapi tidak ada jadwal yang valid.');
        }

        return redirect('/dashboard')->with('success', "KRS berhasil diproses! {$saved} jadwal ditemukan.");
    }

    private function convertPdfToJpg(string $pdfPath): ?string
    {
        $gsPath = $this->findGhostScript();
        if (!$gsPath) {
            Log::error('GhostScript tidak ditemukan.');
            return null;
        }

        $outputPath = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'krs_' . uniqid() . '.jpg';

        $cmd = sprintf(
            '"%s" -dNOPAUSE -dBATCH -dSAFER -sDEVICE=jpeg -r200 -dFirstPage=1 -dLastPage=1 -dJPEGQ=95 -sOutputFile="%s" "%s" 2>&1',
            $gsPath, $outputPath, $pdfPath
        );

        exec($cmd, $output, $returnCode);
        Log::info('GhostScript', ['code' => $returnCode, 'out' => implode("\n", $output)]);

        if ($returnCode !== 0 || !file_exists($outputPath) || filesize($outputPath) < 1000) {
            Log::error('GhostScript gagal', ['output' => $output]);
            return null;
        }

        return $outputPath;
    }

    private function findGhostScript(): ?string
    {
        $gsDir = 'C:\\Program Files\\gs';
        if (is_dir($gsDir)) {
            $versions = glob($gsDir . '\\gs*\\bin\\gswin64c.exe');
            if (!empty($versions)) { rsort($versions); return $versions[0]; }
        }
        foreach (['gswin64c', 'gswin32c', 'gs'] as $gs) {
            exec('where ' . $gs . ' 2>nul', $out, $code);
            if ($code === 0 && !empty($out[0])) return trim($out[0]);
        }
        return null;
    }

    private function parseImageViaVision(string $imagePath): array
    {
        $apiKey = env('GEMINI_API_KEY');
        if (!$apiKey) { Log::warning('GEMINI_API_KEY tidak ada.'); return []; }

        $raw = @file_get_contents($imagePath);
        if (!$raw) { Log::warning('Gagal baca gambar: ' . $imagePath); return []; }

        $imageData = base64_encode($raw);
        $mimeType  = 'image/jpeg';

        $prompt = "Kamu membaca tabel KRS Universitas Malikussaleh.\n\n"
            . "KOLOM TABEL (kiri ke kanan):\n"
            . "No | Kelas | Kode | Nama Matkul | SKS | Ke | Sn | Sl | Rb | Km | Jm | Sb | Mg\n\n"
            . "Sn=Senin, Sl=Selasa, Rb=Rabu, Km=Kamis, Jm=Jumat, Sb=Sabtu, Mg=Minggu\n\n"
            . "Setiap baris matakuliah punya sel jadwal di salah satu kolom hari.\n"
            . "Sel berisi: jam (HH:MM-HH:MM) dan ruangan di bawahnya.\n"
            . "Hari = kolom tempat jam itu berada.\n\n"
            . "Kembalikan HANYA JSON array (tanpa markdown):\n"
            . '[{"no":"1","class":"A2","course_code":"INF1843","course":"DATA MINING",'
            . '"day":"Kamis","start_time":"14:00","end_time":"16:30","room":"INF-RUANG KULIAH IV"}]';

        $models = ['gemini-2.5-flash', 'gemini-2.5-flash-lite', 'gemini-2.0-flash', 'gemini-2.0-flash-lite'];

        foreach ($models as $model) {
            $url  = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}";
            $body = json_encode([
                'contents'         => [['parts' => [['text' => $prompt], ['inline_data' => ['mime_type' => $mimeType, 'data' => $imageData]]]]],
                'generationConfig' => ['temperature' => 0],
            ]);

            $ch = curl_init($url);
            curl_setopt_array($ch, [
                CURLOPT_POST => true, CURLOPT_POSTFIELDS => $body,
                CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
                CURLOPT_RETURNTRANSFER => true, CURLOPT_TIMEOUT => 90,
                CURLOPT_CONNECTTIMEOUT => 15, CURLOPT_SSL_VERIFYPEER => false,
            ]);

            $resp     = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $curlErr  = curl_error($ch);
            curl_close($ch);

            if ($curlErr) { Log::warning("cURL [{$model}]: {$curlErr}"); continue; }

            $data = json_decode($resp, true);
            if ($httpCode === 429) { sleep(3); continue; }
            if ($httpCode !== 200) { Log::warning("HTTP {$httpCode} [{$model}]"); continue; }

            $text = $data['candidates'][0]['content']['parts'][0]['text'] ?? null;
            if (empty($text)) continue;

            $text   = trim(preg_replace(['/^```(?:json)?\s*/i', '/\s*```\s*$/i'], '', trim($text)));
            $parsed = json_decode($text, true);

            if (json_last_error() === JSON_ERROR_NONE && is_array($parsed)) {
                Log::info("Vision OK [{$model}]", ['total' => count($parsed)]);
                return $parsed;
            }
        }

        Log::error('Semua model Vision gagal.');
        return [];
    }

    private function normalizeTime(string $time): ?string
    {
        $time = trim(str_replace('.', ':', $time));
        if (preg_match('/^(\d{1,2}):(\d{2})$/', $time, $m)) {
            return sprintf('%02d:%02d:00', (int)$m[1], (int)$m[2]);
        }
        if (preg_match('/^(\d{1,2}):(\d{2}):(\d{2})$/', $time, $m)) {
            return sprintf('%02d:%02d:%02d', (int)$m[1], (int)$m[2], (int)$m[3]);
        }
        return null;
    }
}