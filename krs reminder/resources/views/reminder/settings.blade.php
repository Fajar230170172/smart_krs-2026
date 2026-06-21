<x-app-layout>
<div class="min-h-screen bg-gray-50">

    <div class="hero-gradient py-8 px-6" style="background:linear-gradient(135deg,#16a34a,#15803d);">
        <div class="max-w-3xl mx-auto">
            <h1 style="color:#fff;font-size:22px;font-weight:800;">⚙️ Pengaturan Pengingat Email</h1>
            <p style="color:rgba(255,255,255,.8);font-size:14px;margin-top:4px;">
                Atur email tujuan untuk menerima pengingat kuliah otomatis
            </p>
        </div>
    </div>

    <div class="max-w-3xl mx-auto px-6 py-8">

        @if(session('success'))
        <div style="background:#f0fdf4;border:1px solid #86efac;border-radius:12px;padding:16px 20px;margin-bottom:24px;color:#15803d;font-weight:500;font-size:14px;display:flex;gap:10px;align-items:flex-start;">
            <span>✅</span><span>{{ session('success') }}</span>
        </div>
        @endif

        @if(session('error'))
        <div style="background:#fef2f2;border:1px solid #fca5a5;border-radius:12px;padding:16px 20px;margin-bottom:24px;color:#b91c1c;font-weight:500;font-size:14px;display:flex;gap:10px;align-items:flex-start;">
            <span>❌</span><span>{{ session('error') }}</span>
        </div>
        @endif

        {{-- Cara kerja --}}
        <div style="background:#fff;border-radius:16px;padding:24px;box-shadow:0 1px 3px rgba(0,0,0,.06);margin-bottom:24px;border-left:4px solid #16a34a;">
            <h2 style="font-size:16px;font-weight:700;color:#111827;margin-bottom:12px;">📬 Cara Kerja Pengingat</h2>
            <div style="display:flex;flex-direction:column;gap:10px;">
                <div style="display:flex;gap:12px;align-items:flex-start;">
                    <span style="background:#dcfce7;color:#16a34a;font-weight:800;font-size:12px;padding:2px 8px;border-radius:20px;flex-shrink:0;">1</span>
                    <span style="font-size:14px;color:#374151;">Atur email tujuan di bawah ini</span>
                </div>
                <div style="display:flex;gap:12px;align-items:flex-start;">
                    <span style="background:#dcfce7;color:#16a34a;font-weight:800;font-size:12px;padding:2px 8px;border-radius:20px;flex-shrink:0;">2</span>
                    <span style="font-size:14px;color:#374151;">Jalankan scheduler Laravel di terminal: <code style="background:#f3f4f6;padding:2px 6px;border-radius:4px;font-size:12px;">php artisan schedule:work</code></span>
                </div>
                <div style="display:flex;gap:12px;align-items:flex-start;">
                    <span style="background:#dcfce7;color:#16a34a;font-weight:800;font-size:12px;padding:2px 8px;border-radius:20px;flex-shrink:0;">3</span>
                    <span style="font-size:14px;color:#374151;">Sistem otomatis kirim email <strong>40 menit sebelum</strong> setiap kelas dimulai</span>
                </div>
            </div>
        </div>

        {{-- Form email --}}
        <div style="background:#fff;border-radius:16px;padding:28px;box-shadow:0 1px 3px rgba(0,0,0,.06);margin-bottom:24px;">
            <h2 style="font-size:16px;font-weight:700;color:#111827;margin-bottom:20px;">📧 Email Tujuan Pengingat</h2>

            <form action="{{ route('reminder.save') }}" method="POST">
                @csrf
                <div style="margin-bottom:16px;">
                    <label style="display:block;font-size:13px;font-weight:600;color:#374151;margin-bottom:6px;">
                        Alamat Email
                    </label>
                    <input
                        type="email"
                        name="reminder_email"
                        value="{{ old('reminder_email', $user->reminder_email ?? $user->email) }}"
                        placeholder="contoh@gmail.com"
                        required
                        style="width:100%;padding:12px 16px;border:1.5px solid #d1d5db;border-radius:10px;font-size:14px;outline:none;box-sizing:border-box;"
                        onfocus="this.style.borderColor='#16a34a'"
                        onblur="this.style.borderColor='#d1d5db'"
                    >
                    @error('reminder_email')
                        <p style="color:#b91c1c;font-size:12px;margin-top:4px;">{{ $message }}</p>
                    @enderror
                    <p style="font-size:12px;color:#6b7280;margin-top:6px;">
                        Email ini akan menerima pengingat 40 menit sebelum setiap kelas dimulai.
                    </p>
                </div>

                <button type="submit" style="background:linear-gradient(135deg,#16a34a,#15803d);color:#fff;font-weight:700;font-size:14px;padding:12px 24px;border-radius:10px;border:none;cursor:pointer;width:100%;">
                    💾 Simpan Email Pengingat
                </button>
            </form>
        </div>

        {{-- Tabel jadwal + tombol test --}}
        <div style="background:#fff;border-radius:16px;padding:28px;box-shadow:0 1px 3px rgba(0,0,0,.06);">
            <h2 style="font-size:16px;font-weight:700;color:#111827;margin-bottom:6px;">🧪 Test Kirim Email</h2>
            <p style="font-size:13px;color:#6b7280;margin-bottom:20px;">
                Klik tombol di bawah untuk test kirim email pengingat ke
                <strong>{{ $user->reminder_email ?? $user->email }}</strong>
            </p>

            @forelse($schedules as $schedule)
            <div style="display:flex;align-items:center;justify-content:space-between;padding:12px 0;border-bottom:1px solid #f3f4f6;gap:12px;flex-wrap:wrap;">
                <div>
                    <div style="font-size:14px;font-weight:600;color:#111827;">{{ $schedule->course }}</div>
                    <div style="font-size:12px;color:#6b7280;margin-top:2px;">
                        {{ $schedule->day }} •
                        {{ \Carbon\Carbon::createFromFormat('H:i:s', $schedule->start_time)->format('H:i') }}–{{ \Carbon\Carbon::createFromFormat('H:i:s', $schedule->end_time)->format('H:i') }} •
                        {{ $schedule->room }}
                    </div>
                </div>
                <form action="{{ route('reminder.test', $schedule->id) }}" method="POST">
                    @csrf
                    <button type="submit" style="background:#f0fdf4;color:#16a34a;border:1.5px solid #86efac;font-weight:600;font-size:12px;padding:7px 14px;border-radius:8px;cursor:pointer;white-space:nowrap;">
                        📨 Test Email
                    </button>
                </form>
            </div>
            @empty
            <p style="font-size:14px;color:#9ca3af;text-align:center;padding:20px 0;">
                Belum ada jadwal. Upload KRS terlebih dahulu.
            </p>
            @endforelse
        </div>

        <div style="text-align:center;margin-top:20px;">
            <a href="{{ route('dashboard') }}" style="font-size:14px;color:#6b7280;text-decoration:none;">
                ← Kembali ke Dashboard
            </a>
        </div>

    </div>
</div>
</x-app-layout>
