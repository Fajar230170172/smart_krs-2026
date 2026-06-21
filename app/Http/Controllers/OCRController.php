<?php

namespace App\Http\Controllers;

use GeminiAPI\Client;
use GeminiAPI\Resources\Parts\TextPart;

class OCRController extends Controller
{
    public function parseKRS($text)
    {
        $client = new Client(
            env('GEMINI_API_KEY')
        );

        $prompt = "
        Berikut isi KRS mahasiswa.

        Ambil semua jadwal kuliah.
        sn=senin, sl=selasa, rb=rabu, km=kamis, jm=jumat, sb=sabtu
        Kembalikan dalam JSON.

        Format:

        [
          {
            \"course\": \"Pemrograman Web\",
            \"day\": \"Senin\",
            \"start_time\": \"08:00\",
            \"end_time\": \"10:00\",
            \"room\": \"Lab 1\"
          }
        ]

        Isi:
        " . $text;

        $response = $client
            ->geminiPro()
            ->generateContent(
                new TextPart($prompt)
            );

        return $response->text();
    }
}