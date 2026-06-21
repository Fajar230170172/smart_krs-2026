<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartKRS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body{
            background:#0f172a;
            background-image:
                radial-gradient(circle at top left,#7c3aed22,transparent 30%),
                radial-gradient(circle at bottom right,#06b6d422,transparent 30%);
        }
    </style>
</head>
<body class="text-white min-h-screen">

<nav class="backdrop-blur-md bg-white/5 border-b border-white/10 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold bg-gradient-to-r from-violet-400 to-cyan-400 bg-clip-text text-transparent">
            SmartKRS
        </h1>

        <div class="space-x-4">
            <a href="/login" class="px-5 py-2 rounded-xl border border-white/20 hover:bg-white/10 transition">
                Login
            </a>

            <a href="/register" class="px-5 py-2 rounded-xl bg-violet-600 hover:bg-violet-700 transition">
                Register
            </a>
        </div>
    </div>
</nav>

<section class="max-w-7xl mx-auto px-6 py-24 grid lg:grid-cols-2 gap-16 items-center">

    <div>
        <span class="inline-block px-4 py-2 rounded-full bg-violet-500/20 text-violet-300 text-sm mb-6">
            AI Powered Academic Reminder
        </span>

        <h2 class="text-5xl font-bold leading-tight mb-6">
            Jangan Sampai
            <span class="text-violet-400">Terlambat Kuliah</span>
            Lagi
        </h2>

        <p class="text-slate-300 text-lg leading-relaxed mb-8">
            Upload KRS kamu, sistem membaca jadwal otomatis,
            lalu Kirim Pengingat ke Email.
            Semua pengingat kelas aktif otomatis.
        </p>
    </div>

    <div class="relative">
        <div class="absolute inset-0 bg-violet-600/20 blur-3xl rounded-full"></div>

        <div class="relative bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-8 shadow-2xl">
            <div class="grid grid-cols-2 gap-4">

                <div class="bg-slate-800/60 rounded-2xl p-5">
                    <p class="text-sm text-slate-400">Upload KRS</p>
                    <h3 class="text-xl font-semibold mt-2">PDF Reader</h3>
                </div>

                <div class="bg-slate-800/60 rounded-2xl p-5">
                    <p class="text-sm text-slate-400">Sinkronisasi</p>
                    <h3 class="text-xl font-semibold mt-2">Pesan Email</h3>
                </div>

                <div class="bg-slate-800/60 rounded-2xl p-5">
                    <p class="text-sm text-slate-400">Reminder</p>
                    <h3 class="text-xl font-semibold mt-2">Notifikasi</h3>
                </div>

                <div class="bg-slate-800/60 rounded-2xl p-5">
                    <p class="text-sm text-slate-400">AI Parsing</p>
                    <h3 class="text-xl font-semibold mt-2">Gemini OCR</h3>
                </div>

            </div>
        </div>
    </div>

</section>
    </div>
</section>

<footer class="text-center py-10 text-slate-500 border-t border-white/10 mt-20">
    © {{ date('Y') }} SmartKRS — FAR
</footer>

</body>
</html>