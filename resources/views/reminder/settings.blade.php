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
            border-color: #6366f1;
        }

        .btn-purple {
            display: inline-flex; align-items: center; justify-content: center; gap: 8px;
            background: linear-gradient(135deg, #a855f7, #7c3aed);
            color: #fff; font-weight: 700; font-size: 14px;
            padding: 14px 24px; border-radius: 12px;
            border: none; cursor: pointer; text-decoration: none;
            transition: opacity .2s, transform .15s, box-shadow .2s;
            width: 100%;
        }
        .btn-purple:hover { 
            opacity: .95; 
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(168, 85, 247, 0.3);
        }
        .btn-purple:active { transform: translateY(1px); }

        .input-premium {
            background: #1c193b;
            border: 1.5px solid #282452;
            color: #f1f5f9;
            border-radius: 12px;
            padding: 14px 16px;
            width: 100%;
            transition: border-color .2s, box-shadow .2s;
            font-size: 14px;
        }
        .input-premium:focus {
            outline: none;
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
        }

        .step-badge {
            width: 28px; height: 28px;
            border-radius: 50%;
            display: inline-flex; align-items: center; justify-content: center;
            font-size: 13px; font-weight: 800;
            background: linear-gradient(135deg, #6366f1, #4f46e5);
            color: #fff;
            flex-shrink: 0;
            box-shadow: 0 2px 4px rgba(99, 102, 241, 0.3);
        }

        .btn-test {
            background: #1c193b;
            color: #a5b4fc;
            border: 1.5px solid #282452;
            font-weight: 600;
            font-size: 12px;
            padding: 8px 16px;
            border-radius: 10px;
            cursor: pointer;
            white-space: nowrap;
            transition: all 0.2s;
        }
        .btn-test:hover {
            background: #282452;
            border-color: #6366f1;
            color: #fff;
            transform: translateY(-1px);
        }

        .alert-success {
            background: linear-gradient(135deg, #064e3b, #022c22);
            border: 1px solid #059669;
            border-radius: 14px;
            padding: 16px 20px;
            margin-bottom: 24px;
            color: #a7f3d0;
            font-weight: 500;
            font-size: 14px;
            display: flex;
            gap: 12px;
            align-items: flex-start;
        }

        .alert-error {
            background: linear-gradient(135deg, #7f1d1d, #450a0a);
            border: 1px solid #dc2626;
            border-radius: 14px;
            padding: 16px 20px;
            margin-bottom: 24px;
            color: #fca5a5;
            font-weight: 500;
            font-size: 14px;
            display: flex;
            gap: 12px;
            align-items: flex-start;
        }
    </style>
</head>

<div class="min-h-screen text-slate-100" style="background-image: radial-gradient(circle at top right, #131129 0%, #0f172a 60%, #020617 100%);">

    {{-- HERO HEADER --}}
    <div class="hero-gradient py-8 px-6">
        <div class="max-w-3xl mx-auto flex items-center justify-between">
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-1">
                    <span style="font-size:26px;"></span>
                    <h1 style="color:#fff; font-size:26px; font-weight:800; letter-spacing:-0.5px;">Pengaturan Pengingat Email</h1>
                </div>
                <p style="color:rgba(255,255,255,0.75); font-size:15px; font-weight:500;">
                    Atur email tujuan Anda untuk menerima pengingat jadwal kuliah otomatis.
                </p>
            </div>
        </div>
    </div>

    {{-- MAIN CONTAINER --}}
    <div class="max-w-3xl mx-auto px-6 py-8">

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

        {{-- CARD 1: CARA KERJA --}}
        <div class="card p-6 mb-6" style="border-left: 4px solid #6366f1;">
            <div class="flex items-center gap-3 mb-5 border-b border-slate-800 pb-3">
                <span style="font-size:20px;"></span>
                <h2 style="font-size:16px; font-weight:700; color:#f1f5f9;">Cara Kerja Pengingat</h2>
            </div>
            
            <div class="space-y-4">
                <div class="flex items-start gap-4">
                    <span class="step-badge">1</span>
                    <p style="font-size:14px; color:#94a3b8; margin-top:3px;">
                        Atur email tujuan Anda pada formulir di bawah ini.
                    </p>
                </div>
                
                <div class="flex items-start gap-4">
                    <span class="step-badge">2</span>
                    <div class="w-full">
                        <p style="font-size:14px; color:#94a3b8; margin-top:3px; margin-bottom:8px;">
                            Jalankan scheduler Laravel di terminal server Anda:
                        </p>
                    </div>
                </div>

                <div class="flex items-start gap-4">
                    <span class="step-badge">3</span>
                    <p style="font-size:14px; color:#94a3b8; margin-top:3px;">
                        Sistem akan mengirimkan email secara otomatis <strong style="color:#a5b4fc;">40 menit sebelum</strong> setiap jam kuliah dimulai.
                    </p>
                </div>
            </div>
        </div>

        {{-- CARD 2: PENGATURAN EMAIL --}}
        <div class="card p-6 mb-6">
            <div class="flex items-center gap-3 mb-5 border-b border-slate-800 pb-3">
                <span style="font-size:20px;"></span>
                <h2 style="font-size:16px; font-weight:700; color:#f1f5f9;">Email Tujuan Pengingat</h2>
            </div>

            <form action="{{ route('reminder.save') }}" method="POST">
                @csrf
                <div class="mb-5">
                    <label for="reminder_email" style="display:block; font-size:13px; font-weight:600; color:#94a3b8; margin-bottom:8px;">
                        Alamat Email Penerima
                    </label>
                    <input 
                        type="email" 
                        name="reminder_email" 
                        id="reminder_email" 
                        class="input-premium" 
                        placeholder="email-anda@contoh.com" 
                        value="{{ old('reminder_email', $user->reminder_email ?? $user->email) }}" 
                        required
                    >
                    @error('reminder_email')
                        <p style="color:#f87171; font-size:12px; margin-top:6px; font-weight:500;">{{ $message }}</p>
                    @enderror
                    <p style="font-size:12px; color:#64748b; margin-top:8px; line-height:1.4;">
                        Email ini akan digunakan untuk menerima notifikasi pengingat kuliah Anda.
                    </p>
                </div>

                <button type="submit" class="btn-purple">
                    <span></span>
                    <span>Simpan Email Pengingat</span>
                </button>
            </form>
        </div>

        {{-- CARD 3: TEST KIRIM EMAIL --}}
        <div class="card p-6">
            <div class="flex items-center gap-3 mb-5 border-b border-slate-800 pb-3">
                <span style="font-size:20px;"></span>
                <h2 style="font-size:16px; font-weight:700; color:#f1f5f9;">Uji Coba Kirim Email</h2>
            </div>
            <p style="font-size:13px; color:#94a3b8; margin-bottom:20px; line-height:1.5;">
                Klik tombol di samping jadwal untuk menguji pengiriman email pengingat simulasi langsung ke alamat: <strong style="color: #a5b4fc;">{{ $user->reminder_email ?? $user->email }}</strong>.
            </p>

            <div style="display:flex; flex-direction:column; gap:4px;">
                @forelse($schedules as $schedule)
                <div style="display:flex; align-items:center; justify-content:space-between; padding:14px 0; border-bottom:1px solid #1c193b; gap:12px; flex-wrap:wrap;">
                    <div>
                        <div style="font-size:14px; font-weight:700; color:#f1f5f9;">{{ $schedule->course }}</div>
                        <div style="font-size:12px; color:#94a3b8; margin-top:3px; display:flex; gap:6px; align-items:center;">
                            <span style="background:#1c193b; border:1px solid #282452; color:#a5b4fc; padding:2px 8px; border-radius:12px; font-weight:700;">{{ $schedule->day }}</span>
                            <span>•</span>
                            <span style="font-weight:600; font-family:monospace; color:#cbd5e1;">{{ \Carbon\Carbon::createFromFormat('H:i:s', $schedule->start_time)->format('H:i') }}–{{ \Carbon\Carbon::createFromFormat('H:i:s', $schedule->end_time)->format('H:i') }}</span>
                            <span>•</span>
                            <span style="background:#1e1b4b; border:1px solid #2e2a54; color:#a5b4fc; padding:2px 8px; border-radius:6px; font-size:11px; font-weight:600;">{{ $schedule->room }}</span>
                        </div>
                    </div>
                    <form action="{{ route('reminder.test', $schedule->id) }}" method="POST" style="margin:0;">
                        @csrf
                        <button type="submit" class="btn-test">
                            Test Email
                        </button>
                    </form>
                </div>
                @empty
                <div style="text-align:center; padding:30px 20px; color:#64748b;">
                    <span style="font-size:32px; display:block; margin-bottom:8px;">📅</span>
                    <p style="font-weight:600; font-size:14px; color:#94a3b8;">Belum ada jadwal kuliah</p>
                    <p style="font-size:12px; color:#64748b; margin-top:2px;">Silakan unggah KRS Anda terlebih dahulu di Dashboard.</p>
                </div>
                @endforelse
            </div>
        </div>

        {{-- BACK LINK --}}
        <div style="text-align:center; margin-top:28px;">
            <a href="{{ route('dashboard') }}" style="font-size:14px; color: #94a3b8; text-decoration:none; font-weight:600; display:inline-flex; align-items:center; gap:6px; transition: color 0.2s;" onmouseover="this.style.color='#a855f7'" onmouseout="this.style.color='#94a3b8'">
                <span>←</span> Kembali ke Dashboard
            </a>
        </div>

    </div>
</div>
</x-app-layout>