<x-app-layout>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }

        .hero-gradient {
            background: linear-gradient(135deg, #16a34a 0%, #15803d 40%, #ca8a04 100%);
            position: relative;
            overflow: hidden;
        }
        .hero-gradient::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,.06), 0 4px 16px rgba(0,0,0,.06);
            transition: transform .2s, box-shadow .2s;
        }
        .card:hover { transform: translateY(-2px); box-shadow: 0 4px 24px rgba(0,0,0,.1); }

        .btn-primary {
            display: inline-flex; align-items: center; justify-content: center; gap: 8px;
            background: linear-gradient(135deg, #16a34a, #15803d);
            color: #fff; font-weight: 700; font-size: 14px;
            padding: 12px 20px; border-radius: 12px;
            border: none; cursor: pointer; text-decoration: none;
            transition: opacity .2s, transform .15s;
            width: 100%;
        }
        .btn-primary:hover { opacity: .9; transform: translateY(-1px); }

        .btn-yellow {
            display: inline-flex; align-items: center; justify-content: center; gap: 8px;
            background: linear-gradient(135deg, #d97706, #ca8a04);
            color: #fff; font-weight: 700; font-size: 14px;
            padding: 12px 20px; border-radius: 12px;
            border: none; cursor: pointer; text-decoration: none;
            transition: opacity .2s, transform .15s;
            width: 100%;
        }
        .btn-yellow:hover { opacity: .9; transform: translateY(-1px); }

        .btn-blue {
            display: inline-flex; align-items: center; justify-content: center; gap: 8px;
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: #fff; font-weight: 700; font-size: 14px;
            padding: 12px 20px; border-radius: 12px;
            border: none; cursor: pointer; text-decoration: none;
            transition: opacity .2s, transform .15s;
            width: 100%;
        }
        .btn-blue:hover { opacity: .9; transform: translateY(-1px); }

        .btn-small {
            display: inline-flex; align-items: center; gap: 5px;
            background: linear-gradient(135deg, #16a34a, #15803d);
            color: #fff; font-weight: 600; font-size: 12px;
            padding: 7px 14px; border-radius: 9px;
            border: none; cursor: pointer; text-decoration: none;
            transition: opacity .2s;
            white-space: nowrap;
        }
        .btn-small:hover { opacity: .85; }

        .file-input-wrapper {
            position: relative; overflow: hidden;
            border: 2px dashed #bbf7d0; border-radius: 12px;
            padding: 16px; text-align: center;
            background: #f0fdf4; cursor: pointer;
            transition: border-color .2s, background .2s;
        }
        .file-input-wrapper:hover { border-color: #16a34a; background: #dcfce7; }
        .file-input-wrapper input[type=file] {
            position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%;
        }

        .upload-loading {
            display: none;
            align-items: center; justify-content: center; gap: 10px;
            background: #f0fdf4; border-radius: 12px; padding: 16px;
            color: #15803d; font-weight: 600; font-size: 14px;
        }
        .spinner {
            width: 20px; height: 20px;
            border: 3px solid #bbf7d0;
            border-top-color: #16a34a;
            border-radius: 50%;
            animation: spin .8s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        .badge-day {
            display: inline-block; padding: 3px 10px;
            border-radius: 20px; font-size: 11px; font-weight: 700;
        }
        .day-senin   { background:#dbeafe; color:#1e40af; }
        .day-selasa  { background:#ede9fe; color:#6b21a8; }
        .day-rabu    { background:#dcfce7; color:#166534; }
        .day-kamis   { background:#fef9c3; color:#854d0e; }
        .day-jumat   { background:#ffedd5; color:#9a3412; }
        .day-sabtu   { background:#fce7f3; color:#9d174d; }
        .day-minggu  { background:#fee2e2; color:#991b1b; }

        .table-row { transition: background .15s; }
        .table-row:hover { background: #f0fdf4; }

        .alert-success {
            display: flex; align-items: flex-start; gap: 12px;
            background: linear-gradient(135deg, #f0fdf4, #dcfce7);
            border: 1px solid #86efac; border-radius: 14px;
            padding: 16px 20px; margin-bottom: 24px;
            color: #15803d; font-weight: 500; font-size: 14px;
        }
        .alert-error {
            display: flex; align-items: flex-start; gap: 12px;
            background: #fef2f2; border: 1px solid #fca5a5;
            border-radius: 14px; padding: 16px 20px; margin-bottom: 24px;
            color: #b91c1c; font-weight: 500; font-size: 14px;
        }

        .empty-state { text-align: center; padding: 60px 20px; color: #9ca3af; }
        .empty-state svg { margin: 0 auto 16px; display: block; }

        .card-icon {
            width: 48px; height: 48px; border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 22px; margin-bottom: 14px;
        }
        .icon-green { background: #dcfce7; }
        .icon-yellow { background: #fef9c3; }
        .icon-blue { background: #dbeafe; }

        .count-badge {
            background: linear-gradient(135deg, #fbbf24, #d97706);
            color: #fff; font-weight: 800; font-size: 13px;
            padding: 5px 14px; border-radius: 20px;
        }
    </style>
</head>

<div class="min-h-screen bg-gray-50">

    {{-- HERO --}}
    <div class="hero-gradient py-8 px-6">
        <div class="max-w-6xl mx-auto">
            <div class="flex items-center gap-3 mb-1">
                <h1 style="color:#fff; font-size:26px; font-weight:800; letter-spacing:-0.5px;">SmartKRS</h1>
            </div>
            <p style="color:rgba(255,255,255,0.85); font-size:15px; font-weight:500;">
                Pengingat jadwal kuliah otomatis dari file KRS
            </p>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-6 py-8">

        {{-- ALERTS --}}
        @if(session('success'))
        <div class="alert-success">
            <span style="font-size:20px; flex-shrink:0;">✅</span>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        @if(session('error'))
        <div class="alert-error">
            <span style="font-size:20px; flex-shrink:0;">❌</span>
            <span>{{ session('error') }}</span>
        </div>
        @endif

        {{-- ACTION CARDS --}}
        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap:20px; margin-bottom:28px;">

            {{-- Card 1: Upload KRS --}}
            <div class="card" style="padding:24px; border-top: 3px solid #16a34a;">
                <h2 style="font-size:16px; font-weight:700; color:#111827; margin-bottom:6px;">
                    Langkah 1: Pilih KRS
                </h2>
                <p style="font-size:13px; color:#6b7280; margin-bottom:16px; line-height:1.5;">
                    Upload file PDF KRS kamu. Sistem akan membaca jadwal otomatis menggunakan AI.
                </p>

                <form action="{{ route('upload.krs') }}" method="POST" enctype="multipart/form-data" id="krsForm">
                    @csrf
                    <div class="file-input-wrapper" id="fileWrapper">
                        <input
                            type="file"
                            name="krs_file"
                            id="krs_file"
                            accept=".pdf"
                            onchange="handleFileUpload(this)"
                        >
                        <div id="fileLabel">
                            <div style="font-size:24px; margin-bottom:6px;">📁</div>
                            <div style="font-size:13px; font-weight:600; color:#15803d;">Pilih file PDF</div>
                            <div style="font-size:11px; color:#86efac; margin-top:2px;">atau drag & drop di sini</div>
                        </div>
                    </div>

                    <div class="upload-loading" id="uploadLoading">
                        <div class="spinner"></div>
                        <span>Membaca KRS dengan AI...</span>
                    </div>
                </form>
            </div>

            {{-- Card 2: Pengaturan Email Reminder --}}
            <div class="card" style="padding:24px; border-top: 3px solid #d97706;">
                <h2 style="font-size:16px; font-weight:700; color:#111827; margin-bottom:6px;">
                    Pengingat via Email
                </h2>
                <p style="font-size:13px; color:#6b7280; margin-bottom:16px; line-height:1.5;">
                    Terima email otomatis <strong>40 menit sebelum</strong> setiap kelas dimulai. Atur email tujuan dan test kirim di sini.
                </p>
                <a href="{{ route('reminder.settings') }}" class="btn-yellow">
                    ⚙️ Atur Pengingat Email
                </a>
            </div>

            {{-- Card 3: Download ICS --}}
            <div class="card" style="padding:24px; border-top: 3px solid #2563eb;">
                <h2 style="font-size:16px; font-weight:700; color:#111827; margin-bottom:6px;">
                    Download File Kalender
                </h2>
                <p style="font-size:13px; color:#6b7280; margin-bottom:16px; line-height:1.5;">
                    Download file <strong>.ICS</strong> untuk import ke kalender HP, iPhone, atau Outlook. Tanpa perlu login Google.
                </p>
                <a href="#" onclick="alert('Fitur ini dihapus. Gunakan pengingat email.')" class="btn-blue" style="opacity:.5;cursor:not-allowed;">
                    Download .ICS (nonaktif)
                </a>
            </div>

        </div>

        {{-- TABEL JADWAL --}}
        <div class="card" style="padding:28px;">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; flex-wrap:gap;">
                <h2 style="font-size:20px; font-weight:800; color:#111827;">Jadwal Kuliah</h2>
                <span class="count-badge">
                    {{ $schedules->count() }} Jadwal Terdeteksi
                </span>
            </div>

            <div style="overflow-x:auto;">
                <table style="width:100%; border-collapse:separate; border-spacing:0;">
                    <thead>
                        <tr style="background:#f0fdf4;">
                            <th style="padding:12px 16px; text-align:left; font-size:12px; font-weight:700; color:#15803d; border-bottom:2px solid #bbf7d0;">Mata Kuliah</th>
                            <th style="padding:12px 16px; text-align:left; font-size:12px; font-weight:700; color:#15803d; border-bottom:2px solid #bbf7d0;">Hari</th>
                            <th style="padding:12px 16px; text-align:left; font-size:12px; font-weight:700; color:#15803d; border-bottom:2px solid #bbf7d0;">Jam</th>
                            <th style="padding:12px 16px; text-align:left; font-size:12px; font-weight:700; color:#15803d; border-bottom:2px solid #bbf7d0;">Ruangan</th>
                            <th style="padding:12px 16px; text-align:left; font-size:12px; font-weight:700; color:#15803d; border-bottom:2px solid #bbf7d0;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($schedules as $schedule)
                        @php
                            $dayClass = [
                                'Senin'   => 'day-senin',
                                'Selasa'  => 'day-selasa',
                                'Rabu'    => 'day-rabu',
                                'Kamis'   => 'day-kamis',
                                'Jumat'   => 'day-jumat',
                                'Sabtu'   => 'day-sabtu',
                                'Minggu'  => 'day-minggu',
                            ][$schedule->day] ?? 'day-senin';
                        @endphp
                        <tr class="table-row" style="border-bottom:1px solid #f3f4f6;">
                            <td style="padding:14px 16px;">
                                <span style="font-size:14px; font-weight:600; color:#111827;">{{ $schedule->course }}</span>
                            </td>
                            <td style="padding:14px 16px;">
                                <span class="badge-day {{ $dayClass }}">{{ $schedule->day }}</span>
                            </td>
                            <td style="padding:14px 16px;">
                                <span style="font-size:13px; font-weight:600; color:#374151; font-variant-numeric:tabular-nums;">
                                    {{ \Carbon\Carbon::createFromFormat('H:i:s', $schedule->start_time)->format('H:i') }}
                                    <span style="color:#9ca3af;">–</span>
                                    {{ \Carbon\Carbon::createFromFormat('H:i:s', $schedule->end_time)->format('H:i') }}
                                </span>
                            </td>
                            <td style="padding:14px 16px;">
                                <span style="font-size:12px; background:#f3f4f6; color:#374151; padding:4px 10px; border-radius:8px; font-family:monospace;">
                                    {{ $schedule->room }}
                                </span>
                            </td>
                            <td style="padding:14px 16px;">
                                <a href="{{ route('reminder.settings') }}" class="btn-small">
                                    🔔 Atur Pengingat
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <svg width="64" height="64" viewBox="0 0 64 64" fill="none">
                                        <circle cx="32" cy="32" r="32" fill="#f0fdf4"/>
                                        <path d="M20 28h24M20 36h16" stroke="#86efac" stroke-width="2.5" stroke-linecap="round"/>
                                        <rect x="16" y="18" width="32" height="28" rx="4" stroke="#16a34a" stroke-width="2" fill="none"/>
                                        <path d="M24 14v8M40 14v8" stroke="#16a34a" stroke-width="2" stroke-linecap="round"/>
                                    </svg>
                                    <p style="font-weight:600; font-size:15px; color:#6b7280; margin-bottom:6px;">Belum ada jadwal</p>
                                    <p style="font-size:13px; color:#9ca3af;">Upload file PDF KRS kamu di atas untuk memulai</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<script>
function handleFileUpload(input) {
    if (!input.files || !input.files[0]) return;

    const fileName = input.files[0].name;
    const fileLabel = document.getElementById('fileLabel');
    const uploadLoading = document.getElementById('uploadLoading');
    const fileWrapper = document.getElementById('fileWrapper');

    // Update UI ke loading state
    fileLabel.style.display = 'none';
    fileWrapper.style.display = 'none';
    uploadLoading.style.display = 'flex';

    // Submit form
    document.getElementById('krsForm').submit();
}
</script>
</x-app-layout>