<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Planify') }} — Dashboard</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        <style>
            body { font-family: 'Plus Jakarta Sans', sans-serif; }
            .glass-nav { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(226, 232, 240, 0.5); }
        </style>
    </head>
    <body class="bg-[#f8fafc] antialiased text-slate-900">

        <div class="fixed top-0 left-0 w-full h-full -z-10 overflow-hidden pointer-events-none">
            <div class="absolute top-[-10%] right-[-5%] w-[30%] h-[30%] rounded-full bg-indigo-50 blur-[120px]"></div>
            <div class="absolute bottom-[5%] left-[-5%] w-[20%] h-[20%] rounded-full bg-blue-50 blur-[100px]"></div>
        </div>

        <div class="min-h-screen">
            <nav class="sticky top-0 z-40 glass-nav">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-20">
                        <div class="flex items-center">
                            <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-100">
                                    <div class="w-4 h-4 bg-white rounded-sm rotate-45"></div>
                                </div>
                                <span class="text-xl font-black tracking-tighter">Planify</span>
                            </a>
                        </div>

                        <div class="flex items-center sm:ms-6">
                            <div class="flex items-center gap-4 bg-white/50 border border-slate-200 p-1.5 rounded-2xl">
                                <span class="pl-3 text-sm font-bold text-slate-600">{{ Auth::user()->name }}</span>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="bg-slate-900 text-white p-2.5 rounded-xl hover:bg-red-500 transition-colors shadow-sm">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                    </button>

                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <main class="py-12">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </body>
</html>
