<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pengingat Kuliah</title>
<style>
  body { margin:0; padding:0; background:#f3f4f6; font-family:'Segoe UI',Arial,sans-serif; }
  .wrapper { max-width:560px; margin:32px auto; background:#fff; border-radius:16px; overflow:hidden; box-shadow:0 4px 24px rgba(0,0,0,.08); }
  .header { background:linear-gradient(135deg,#16a34a,#15803d); padding:32px 36px; text-align:center; }
  .header h1 { color:#fff; margin:0; font-size:22px; font-weight:800; letter-spacing:-0.3px; }
  .header p  { color:rgba(255,255,255,.85); margin:6px 0 0; font-size:14px; }
  .body { padding:32px 36px; }
  .countdown { text-align:center; margin-bottom:28px; }
  .countdown .number { font-size:56px; font-weight:900; color:#16a34a; line-height:1; }
  .countdown .label  { font-size:14px; color:#6b7280; font-weight:500; margin-top:4px; }
  .info-card { background:#f0fdf4; border:1px solid #bbf7d0; border-radius:12px; padding:20px 24px; margin-bottom:20px; }
  .info-row { display:flex; align-items:flex-start; gap:12px; margin-bottom:12px; }
  .info-row:last-child { margin-bottom:0; }
  .info-icon { font-size:18px; flex-shrink:0; margin-top:1px; }
  .info-label { font-size:11px; font-weight:700; color:#6b7280; text-transform:uppercase; letter-spacing:.5px; }
  .info-value { font-size:15px; font-weight:700; color:#111827; margin-top:2px; }
  .footer { background:#f9fafb; padding:20px 36px; text-align:center; border-top:1px solid #f3f4f6; }
  .footer p { font-size:12px; color:#9ca3af; margin:0; }
  .footer strong { color:#16a34a; }
</style>
</head>
<body>
<div class="wrapper">

  <div class="header">
    <h1>⏰ Pengingat Kuliah</h1>
    <p>SmartKRS — Sistem Pengingat Jadwal Otomatis</p>
  </div>

  <div class="body">

    <p style="font-size:15px;color:#374151;margin:0 0 24px;">
      Halo, <strong>{{ $studentName }}</strong>! Kelas kamu akan segera dimulai.
    </p>

    <div class="countdown">
      <div class="number">{{ $minutesBefore }}</div>
      <div class="label">menit lagi</div>
    </div>

    <div class="info-card">
      <div class="info-row">
        <span class="info-icon">📚</span>
        <div>
          <div class="info-label">Mata Kuliah</div>
          <div class="info-value">{{ $schedule->course }}</div>
        </div>
      </div>

      <div class="info-row">
        <span class="info-icon">📅</span>
        <div>
          <div class="info-label">Hari &amp; Waktu</div>
          <div class="info-value">
            {{ $schedule->day }},
            {{ \Carbon\Carbon::createFromFormat('H:i:s', $schedule->start_time)->format('H:i') }}
            –
            {{ \Carbon\Carbon::createFromFormat('H:i:s', $schedule->end_time)->format('H:i') }}
            WIB
          </div>
        </div>
      </div>

      <div class="info-row">
        <span class="info-icon">📍</span>
        <div>
          <div class="info-label">Ruangan</div>
          <div class="info-value">{{ $schedule->room }}</div>
        </div>
      </div>

      @if($schedule->class)
      <div class="info-row">
        <span class="info-icon">🏷️</span>
        <div>
          <div class="info-label">Kelas</div>
          <div class="info-value">{{ $schedule->class }}</div>
        </div>
      </div>
      @endif
    </div>

    <p style="font-size:13px;color:#6b7280;text-align:center;margin:0;">
      Jangan lupa siapkan perlengkapan kuliah kamu!
    </p>

  </div>

  <div class="footer">
    <p>Email ini dikirim otomatis oleh <strong>SmartKRS</strong>.<br>
    Pengingat dikirim 40 menit sebelum kelas dimulai.</p>
  </div>

</div>
</body>
</html>
