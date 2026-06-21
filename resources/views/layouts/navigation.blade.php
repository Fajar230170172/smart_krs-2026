<nav x-data="{ open: false }" class="bg-[#111026] border-[#282452] text-slate-200 shadow-lg">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo Aplikasi -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 no-underline">
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-indigo-500 to-purple-600 flex items-center justify-center shadow-md">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"></path>
                            </svg>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links dengan Tombol Kembali (Panah) -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex items-center">
                    <!-- Tombol Kembali (Tanda Panah) -->
                   <a href="{{ url('/') }}"
   class="inline-flex items-center justify-center gap-2 p-1.5 rounded-full text-slate-400 hover:text-white hover:bg-[#1c193b] transition duration-150 ease-in-out"
   title="Kembali ke Halaman Utama">

    <svg class="w-5 h-5"
         fill="none"
         stroke="currentColor"
         stroke-width="2.5"
         viewBox="0 0 24 24"
         xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round"
              stroke-linejoin="round"
              d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18">
        </path>
     </svg>
            <span>Home</span>
        </a>

                    <!-- Navigasi Dashboard -->
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('dashboard') ? 'border-indigo-500 text-white font-bold' : 'border-transparent text-slate-400 hover:text-slate-200' }} text-sm font-medium leading-5 transition duration-150 ease-in-out no-underline">
                        Dashboard
                    </a>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <div class="relative" x-data="{ open: false }" @click.away="open = false" @close.stop="open = false">
                    <div>
                        <button @click="open = ! open" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-lg text-slate-300 hover:text-white bg-[#1c193b] border border-[#282452] hover:bg-[#231f4a] focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ml-1.5">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </div>

                    <!-- Dropdown Menu -->
                    <div x-show="open"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         class="absolute right-0 z-50 mt-2 w-48 rounded-lg shadow-xl origin-top-right bg-[#13112a] border border-[#282452]"
                         style="display: none;">
                        <div class="rounded-lg ring-1 ring-black ring-opacity-5 py-1">
                            <!-- Link ke Profil (Jika ada halaman edit profil) -->
                            @if (Route::has('profile.edit'))
                            <a href="{{ route('profile.edit') }}" class="block w-full px-4 py-2.5 text-left text-sm leading-5 text-slate-300 hover:bg-[#1c193b] hover:text-white transition duration-150 ease-in-out no-underline">
                                Profil Saya
                            </a>
                            @endif

                            <!-- Logout -->
                            <form method="POST" action="{{ route('logout') }}" class="m-0 @if(Route::has('profile.edit')) border-t border-[#1c193b] @endif">
                                @csrf
                                <button type="submit" class="block w-full px-4 py-2.5 text-left text-sm leading-5 text-red-400 hover:bg-[#1c193b] hover:text-red-300 transition duration-150 ease-in-out bg-transparent border-none cursor-pointer w-full">
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hamburger (Menu Mobile) -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-lg text-slate-400 hover:text-white hover:bg-[#1c193b] focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (Mobile) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-[#282452] bg-[#111026]">
        <div class="pt-2 pb-3 space-y-1">
            <!-- Tombol Kembali Mobile -->
            <a href="{{ url('/') }}" class="flex items-center gap-2 w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-left text-base font-medium text-slate-400 hover:text-white hover:bg-[#1c193b] no-underline">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path>
                </svg>
                Kembali ke Beranda
            </a>

            <!-- Dashboard Link Mobile -->
            <a href="{{ route('dashboard') }}" class="block w-full pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('dashboard') ? 'border-indigo-500 text-white bg-[#1c193b] font-semibold' : 'border-transparent text-slate-400 hover:text-slate-200' }} text-left text-base font-medium transition duration-150 ease-in-out no-underline">
                Dashboard
            </a>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-[#282452]">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-slate-400">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Profil Mobile -->
                @if (Route::has('profile.edit'))
                <a href="{{ route('profile.edit') }}" class="block w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-left text-base font-medium text-slate-400 hover:text-white hover:bg-[#1c193b] transition duration-150 ease-in-out no-underline">
                    Profil Saya
                </a>
                @endif

                <!-- Logout Mobile -->
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="block w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-left text-base font-medium text-red-400 hover:text-red-300 hover:bg-[#1c193b] transition duration-150 ease-in-out bg-transparent border-none cursor-pointer w-full">
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>