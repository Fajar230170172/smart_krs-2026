<x-app-layout>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: #030712;
        }

        .hero-gradient {
            background: linear-gradient(135deg, #1e1b4b 0%, #311042 50%, #030712 100%);
            position: relative;
            overflow: hidden;
            border-bottom: 1px solid #2e2a54;
        }
        .hero-gradient::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%236366f1' fill-opacity='0.08'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .card {
            background: #13112a;
            border-radius: 20px;
            border: 1px solid #282452;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            transition: transform .2s, box-shadow .2s, border-color .2s;
        }
        .card:hover { 
            transform: translateY(-2px); 
            box-shadow: 0 4px 24px rgba(99, 102, 241, 0.15); 
            border-color: #4f46e5;
        }

        .btn-primary {
            display: inline-flex; align-items: center; justify-content: center; gap: 8px;
            background: linear-gradient(135deg, #6366f1, #4f46e5);
            color: #fff; font-weight: 700; font-size: 14px;
            padding: 12px 20px; border-radius: 12px;
            border: none; cursor: pointer; text-decoration: none;
            transition: opacity .2s, transform .15s;
            width: 100%;
        }
        .btn-primary:hover { opacity: .9; transform: translateY(-1px); }

        .btn-yellow {
            display: inline-flex; align-items: center; justify-content: center; gap: 8px;
            background: linear-gradient(135deg, #a855f7, #7c3aed);
            color: #fff; font-weight: 700; font-size: 14px;
            padding: 12px 20px; border-radius: 12px;
            border: none; cursor: pointer; text-decoration: none;
            transition: opacity .2s, transform .15s;
            width: 100%;
        }
        .btn-yellow:hover { opacity: .9; transform: translateY(-1px); }

        .btn-blue {
            display: inline-flex; align-items: center; justify-content: center; gap: 8px;
            background: linear-gradient(135deg, #06b6d4, #0891b2);
            color: #fff; font-weight: 700; font-size: 14px;
            padding: 12px 20px; border-radius: 12px;
            border: none; cursor: pointer; text-decoration: none;
            transition: opacity .2s, transform .15s;
            width: 100%;
        }
        .btn-blue:hover { opacity: .9; transform: translateY(-1px); }

        .btn-small {
            display: inline-flex; align-items: center; gap: 5px;
            background: linear-gradient(135deg, #6366f1, #4f46e5);
            color: #fff; font-weight: 600; font-size: 12px;
            padding: 7px 14px; border-radius: 9px;
            border: none; cursor: pointer; text-decoration: none;
            transition: opacity .2s;
            white-space: nowrap;
        }
        .btn-small:hover { opacity: .85; }

        .file-input-wrapper {
            position: relative; overflow: hidden;
            border: 2px dashed #4f46e5; border-radius: 12px;
            padding: 16px; text-align: center;
            background: #13112a; cursor: pointer;
            transition: border-color .2s, background .2s;
        }
        .file-input-wrapper:hover { border-color: #818cf8; background: #1c193b; }
        .file-input-wrapper input[type=file] {
            position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%;
        }

        .upload-loading {
            display: none;
            align-items: center; justify-content: center; gap: 10px;
            background: #13112a; border-radius: 12px; padding: 16px;
            color: #a5b4fc; font-weight: 600; font-size: 14px;
        }
        .spinner {
            width: 20px; height: 20px;
            border: 3px solid #312e81;
            border-top-color: #6366f1;
            border-radius: 50%;
            animation: spin .8s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        .badge-day {
            display: inline-block; padding: 3px 10px;
            border-radius: 20px; font-size: 11px; font-weight: 700;
        }
        .day-senin   { background:#1e3a8a; color:#93c5fd; }
        .day-selasa  { background:#581c87; color:#d8b4fe; }
        .day-rabu    { background:#064e3b; color:#6ee7b7; }
        .day-kamis   { background:#78350f; color:#fde047; }
        .day-jumat   { background:#7c2d12; color:#ffedd5; }
        .day-sabtu   { background:#701a75; color:#fbcfe8; }
        .day-minggu  { background:#7f1d1d; color:#fca5a5; }

        .table-row { transition: background .15s; }
        .table-row:hover { background: #1c193b; }

        .alert-success {
            display: flex; align-items: flex-start; gap: 12px;
            background: linear-gradient(135deg, #064e3b, #022c22);
            border: 1px solid #059669; border-radius: 14px;
            padding: 16px 20px; margin-bottom: 24px;
            color: #a7f3d0; font-weight: 500; font-size: 14px;
        }
        .alert-error {
            display: flex; align-items: flex-start; gap: 12px;
            background: linear-gradient(135deg, #7f1d1d, #450a0a);
            border: 1px solid #dc2626;
            border-radius: 14px; padding: 16px 20px; margin-bottom: 24px;
            color: #fca5a5; font-weight: 500; font-size: 14px;
        }

        .empty-state { text-align: center; padding: 60px 20px; color: #6b7280; }
        .empty-state svg { margin: 0 auto 16px; display: block; }

        .card-icon {
            width: 48px; height: 48px; border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 22px; margin-bottom: 14px;
        }
        .icon-green { background: #1e3a8a; }
        .icon-yellow { background: #581c87; }
        .icon-blue { background: #0c4a6e; }

        .count-badge {
            background: linear-gradient(135deg, #a855f7, #6d28d9);
            color: #fff; font-weight: 800; font-size: 13px;
            padding: 5px 14px; border-radius: 20px;
        }
    </style>
</head>

<div class="min-h-screen text-slate-100" style="background-image: radial-gradient(circle at top right, #131129 0%, #0f172a 60%, #020617 100%);">

    {{-- HERO --}}
    <div class="hero-gradient py-8 px-6">
        <div class="max-w-6xl mx-auto">
            <div class="flex items-center gap-3 mb-1">
                <h1 style="color:#fff; font-size:26px; font-weight:800; letter-spacing:-0.5px;">SmartKRS</h1>
            </div>
            <p style="color:rgba(255,255,255,0.75); font-size:15px; font-weight:500;">
                Pengingat jadwal kuliah otomatis dari file KRS
            </p>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-6 py-8">

        {{-- ALERTS --}}
        @if(session('success'))
        <div class="alert-success">
            <span style="font-size:20px; flex-shrink:0;">&#x2705;</span>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        @if(session('error'))
        <div class="alert-error">
            <span style="font-size:20px; flex-shrink:0;">&#x274C;</span>
            <span>{{ session('error') }}</span>
        </div>
        @endif

        {{-- ACTION CARDS --}}
        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap:20px; margin-bottom:28px;">

            {{-- Card 1: Upload KRS --}}
            <div class="card" style="padding:24px; border-top: 3px solid #6366f1;">
                <h2 style="font-size:16px; font-weight:700; color:#f1f5f9; margin-bottom:6px;">
                    Langkah 1: Upload KRS
                </h2>
                <p style="font-size:13px; color:#94a3b8; margin-bottom:16px; line-height:1.5;">
                    Upload file KRS kamu dalam format <strong>PDF</strong>. Sistem akan membaca jadwal otomatis menggunakan AI.
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
                            <div style="font-size:24px; margin-bottom:6px;">&#x1F4C1;</div>
                            <div style="font-size:13px; font-weight:600; color:#818cf8;">Pilih file KRS (PDF)</div>
                            <div style="font-size:11px; color:#4f46e5; margin-top:2px;">atau drag & drop di sini</div>
                        </div>
                    </div>

                    <div class="upload-loading" id="uploadLoading">
                        <div class="spinner"></div>
                        <span>Membaca KRS dengan AI...</span>
                    </div>
                </form>
            </div>

            {{-- Card 2: Pengaturan Email Reminder --}}
            <div class="card" style="padding:24px; border-top: 3px solid #a855f7;">
                <h2 style="font-size:16px; font-weight:700; color:#f1f5f9; margin-bottom:6px;">
                    Pengingat via Email
                </h2>
                <p style="font-size:13px; color:#94a3b8; margin-bottom:16px; line-height:1.5;">
                    Terima email otomatis <strong>40 menit sebelum</strong> setiap kelas dimulai. Atur email tujuan dan test kirim di sini.
                </p>
                <a href="{{ route('reminder.settings') }}" class="btn-yellow">
                    &#x2699;&#xFE0F; Atur Pengingat Email
                </a>
            </div>
        </div>

        {{-- TABEL JADWAL --}}
        <div class="card" style="padding:28px;">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; flex-wrap:gap;">
                <h2 style="font-size:20px; font-weight:800; color:#f1f5f9;">Jadwal Kuliah</h2>
                <span class="count-badge">
                    {{ $schedules->count() }} Jadwal Terdeteksi
                </span>
            </div>

            <div style="overflow-x:auto;">
                <table style="width:100%; border-collapse:separate; border-spacing:0;">
                    <thead>
                        <tr style="background:#111026;">
                            <th style="padding:12px 16px; text-align:left; font-size:12px; font-weight:700; color:#a5b4fc; border-bottom:2px solid #282452;">Mata Kuliah</th>
                            <th style="padding:12px 16px; text-align:left; font-size:12px; font-weight:700; color:#a5b4fc; border-bottom:2px solid #282452;">Hari</th>
                            <th style="padding:12px 16px; text-align:left; font-size:12px; font-weight:700; color:#a5b4fc; border-bottom:2px solid #282452;">Jam</th>
                            <th style="padding:12px 16px; text-align:left; font-size:12px; font-weight:700; color:#a5b4fc; border-bottom:2px solid #282452;">Ruangan</th>
                            <th style="padding:12px 16px; text-align:left; font-size:12px; font-weight:700; color:#a5b4fc; border-bottom:2px solid #282452; width: 230px;">Aksi</th>
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
                        <tr class="table-row" style="border-bottom:1px solid #232044;">
                            <td style="padding:14px 16px;">
                                <span style="font-size:14px; font-weight:600; color:#fff;">{{ $schedule->course }}</span>
                            </td>
                            <td style="padding:14px 16px;">
                                <span class="badge-day {{ $dayClass }}">{{ $schedule->day }}</span>
                            </td>
                            <td style="padding:14px 16px;">
                                <span style="font-size:13px; font-weight:600; color:#cbd5e1; font-variant-numeric:tabular-nums;">
                                    {{ \Carbon\Carbon::createFromFormat('H:i:s', $schedule->start_time)->format('H:i') }}
                                    <span style="color:#64748b;">&#x2013;</span>
                                    {{ \Carbon\Carbon::createFromFormat('H:i:s', $schedule->end_time)->format('H:i') }}
                                </span>
                            </td>
                            <td style="padding:14px 16px;">
                                <span style="font-size:12px; background:#1c193b; color:#93c5fd; padding:4px 10px; border-radius:8px; font-family:monospace; border: 1px solid #282452;">
                                    {{ $schedule->room }}
                                </span>
                            </td>
                            
                            {{-- KOLOM AKSI: Tombol Berdampingan Horisontal --}}
                            <td style="padding:14px 16px; display: flex; gap: 8px; align-items: center; justify-content: flex-start;">
                                <!-- Tombol Atur Pengingat -->
                                <a href="{{ route('reminder.settings') }}" class="btn-small">
                                    Atur Pengingat
                                </a>

                                <!-- Tombol Hapus -->
                                <form action="{{ route('schedule.destroy', $schedule->id) }}" method="POST" onsubmit="return confirm('Apakah kamu yakin ingin menghapus mata kuliah ini?')" style="margin: 0; display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="display: inline-flex; align-items: center; background: linear-gradient(135deg, #f43f5e, #be123c); color: #fff; font-weight: 600; font-size: 12px; padding: 7px 14px; border-radius: 9px; border: none; cursor: pointer; transition: opacity .2s; white-space: nowrap;" onmouseover="this.style.opacity='0.85'" onmouseout="this.style.opacity='1'">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <svg width="64" height="64" viewBox="0 0 64 64" fill="none">
                                        <circle cx="32" cy="32" r="32" fill="#1c193b"/>
                                        <path d="M20 28h24M20 36h16" stroke="#4f46e5" stroke-width="2.5" stroke-linecap="round"/>
                                        <rect x="16" y="18" width="32" height="28" rx="4" stroke="#6366f1" stroke-width="2" fill="none"/>
                                        <path d="M24 14v8M40 14v8" stroke="#6366f1" stroke-width="2" stroke-linecap="round"/>
                                    </svg>
                                    <p style="font-weight:600; font-size:15px; color:#94a3b8; margin-bottom:6px;">Belum ada jadwal</p>
                                    <p style="font-size:13px; color:#64748b;">Upload foto KRS kamu di atas untuk memulai</p>
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