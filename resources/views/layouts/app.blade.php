<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Planify') }} — Dashboard</title>

        <script>
            if (localStorage.getItem('dark-mode') === 'true' ||
                (!('dark-mode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        </script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        <style>
            body { font-family: 'Plus Jakarta Sans', sans-serif; }
            /* Effet de flou sur la navigation (Glassmorphism) */
            .glass-nav {
                background: rgba(255, 255, 255, 0.7);
                backdrop-filter: blur(12px);
                border-bottom: 1px solid rgba(226, 232, 240, 0.5);
            }
            .dark .glass-nav {
                background: rgba(15, 23, 42, 0.8);
                border-bottom: 1px solid rgba(51, 65, 85, 0.5);
            }
        </style>
    </head>
    <body class="bg-[#f8fafc] dark:bg-slate-900 antialiased text-slate-900 dark:text-slate-100 transition-colors duration-500">

        <div class="fixed top-0 left-0 w-full h-full -z-10 overflow-hidden pointer-events-none">
            <div class="absolute top-[-10%] right-[-5%] w-[30%] h-[30%] rounded-full bg-indigo-50 dark:bg-indigo-900/20 blur-[120px]"></div>
            <div class="absolute bottom-[5%] left-[-5%] w-[20%] h-[20%] rounded-full bg-blue-50 dark:bg-blue-900/20 blur-[100px]"></div>
        </div>

        <div class="min-h-screen">
            <nav class="sticky top-0 z-40 glass-nav transition-colors duration-500">
                <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-20 items-center">

                        <div class="flex items-center">
                            <a href="{{ route('dashboard') }}" class="flex items-center gap-2 sm:gap-3">
                                <div class="w-9 h-9 sm:w-10 sm:h-10 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-100 dark:shadow-none flex-shrink-0">
                                    <div class="w-3.5 h-3.5 bg-white rounded-sm rotate-45"></div>
                                </div>
                                <span class="text-lg sm:text-xl font-black tracking-tighter dark:text-white">Planify</span>
                            </a>
                        </div>

                        <div class="flex items-center gap-1 sm:gap-2 bg-white/50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 p-1 sm:p-1.5 rounded-2xl transition-all">

                            <button onclick="let isDark = document.documentElement.classList.toggle('dark'); localStorage.setItem('dark-mode', isDark);"
                                class="p-2 text-slate-500 dark:text-slate-400 hover:bg-white dark:hover:bg-slate-700 rounded-xl transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500 hidden dark:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-600 block dark:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                                </svg>
                            </button>

                            <div class="w-[1px] h-6 bg-slate-200 dark:bg-slate-700 mx-0.5 sm:mx-1"></div>

                            <a href="{{ route('profile') }}" class="flex items-center gap-2 px-2 sm:pl-3 sm:pr-2 py-1.5 rounded-xl hover:bg-white dark:hover:bg-slate-700 transition-all group">
                                <span class="text-sm font-bold text-slate-600 dark:text-slate-300 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 hidden sm:inline">
                                    {{ Auth::user()->name }}
                                </span>

                                <div class="w-8 h-8 rounded-lg overflow-hidden border border-slate-200 dark:border-slate-700 flex-shrink-0 group-hover:border-indigo-500 transition-colors">
                                    <img src="{{ Auth::user()->getPhotoUrl() }}" class="w-full h-full object-cover" alt="Photo de {{ Auth::user()->name }}">
                                </div>
                                </a>

                            <div class="w-[1px] h-6 bg-slate-200 dark:bg-slate-700 mx-0.5 sm:mx-1"></div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="bg-slate-900 dark:bg-slate-700 text-white p-2 sm:p-2.5 rounded-xl hover:bg-red-500 transition-all active:scale-90 flex items-center justify-center">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>

            <main class="py-8 sm:py-12">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    {{ $slot }}
                </div>
            </main>
        </div>
        {{-- //notifications --}}
        @livewire('notifications')
    </body>
</html>
