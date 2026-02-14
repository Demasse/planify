<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Planify — Dominez votre temps</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(12px); }
    </style>
</head>

<body class="bg-[#f8fafc] text-slate-900 antialiased overflow-x-hidden">

<div class="fixed top-0 left-1/2 -translate-x-1/2 w-full h-full -z-10 overflow-hidden pointer-events-none">
    <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] rounded-full bg-indigo-100/50 blur-[120px]"></div>
    <div class="absolute bottom-[10%] right-[-5%] w-[30%] h-[30%] rounded-full bg-blue-100/50 blur-[100px]"></div>
</div>

<nav class="sticky top-0 z-50 glass border-b border-slate-200/50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
        <div class="text-2xl font-extrabold tracking-tighter flex items-center gap-2">
            <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center">
                <div class="w-3 h-3 bg-white rounded-sm rotate-45"></div>
            </div>
            <span>Planify</span>
        </div>

        <div class="hidden md:flex items-center gap-8 text-sm font-semibold">
            <a href="#features" class="text-slate-500 hover:text-indigo-600 transition">Fonctionnalités</a>
            <a href="#" class="text-slate-500 hover:text-indigo-600 transition">Tarifs</a>
            <div class="h-4 w-[1px] bg-slate-200"></div>
            @auth
                <a href="{{ url('/dashboard') }}" class="text-slate-900 font-bold">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-slate-600 hover:text-indigo-600 transition">Connexion</a>
                <a href="{{ route('register') }}" class="bg-slate-900 text-white px-6 py-2.5 rounded-xl hover:bg-indigo-600 transition shadow-xl shadow-slate-200 active:scale-95">
                    Commencer
                </a>
            @endauth
        </div>
    </div>
</nav>

<header class="max-w-7xl mx-auto px-6 pt-24 pb-20 text-center relative">
    <div class="animate-fade-in-up">
        <span class="inline-flex items-center gap-2 px-4 py-2 text-xs font-black rounded-full bg-indigo-50 text-indigo-600 border border-indigo-100 mb-8 uppercase tracking-widest">
            <span class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-600"></span>
            </span>
            Nouvelle version 2.0 disponible
        </span>

        <h1 class="text-6xl md:text-8xl font-black tracking-tight leading-[0.9] mb-8 italic">
            Simplifiez. <br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-blue-500">Planifiez.</span>
        </h1>

        <p class="text-xl text-slate-500 max-w-2xl mx-auto mb-12 font-medium leading-relaxed">
            Éliminez la surcharge mentale. Une interface minimaliste pour des journées ultra-productives. Conçu pour ceux qui agissent.
        </p>

        <div class="flex flex-col sm:flex-row justify-center gap-6">
            <a href="{{ route('register') }}"
               class="group relative bg-indigo-600 text-white px-10 py-5 rounded-2xl font-bold text-lg hover:bg-indigo-700 transition shadow-2xl shadow-indigo-200 flex items-center justify-center gap-3 active:scale-95">
                Commencer gratuitement
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:translate-x-1 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                </svg>
            </a>
            <a href="#preview" class="px-10 py-5 rounded-2xl font-bold text-lg border-2 border-slate-200 text-slate-700 hover:bg-white transition flex items-center justify-center">
                Voir la démo
            </a>
        </div>
    </div>
</header>

<section id="preview" class="max-w-6xl mx-auto px-6 pb-40">
    <div class="relative group">
        <div class="absolute -inset-1 bg-gradient-to-r from-indigo-500 to-blue-500 rounded-[2.5rem] blur opacity-20 group-hover:opacity-40 transition duration-1000"></div>

        <div class="relative rounded-[2rem] border border-slate-200 bg-white/80 shadow-3xl backdrop-blur-sm overflow-hidden shadow-[0_50px_100px_-20px_rgba(0,0,0,0.15)]">
            <div class="h-14 bg-slate-50/50 flex items-center px-8 justify-between border-b border-slate-100">
                <div class="flex gap-2">
                    <div class="w-3 h-3 bg-red-400/80 rounded-full"></div>
                    <div class="w-3 h-3 bg-yellow-400/80 rounded-full"></div>
                    <div class="w-3 h-3 bg-green-400/80 rounded-full"></div>
                </div>
                <div class="px-4 py-1 bg-slate-100 rounded-full text-[10px] font-bold text-slate-400 tracking-widest uppercase">planify.app</div>
                <div class="w-10"></div>
            </div>

            <div class="p-8 md:p-12">
                <div class="max-w-xl mx-auto space-y-8">
                    <div class="flex justify-between items-end">
                        <div>
                            <h3 class="text-3xl font-extrabold tracking-tight">Ma Journée</h3>
                            <p class="text-indigo-600 font-bold text-sm">Progression 66%</p>
                        </div>
                        <div class="w-12 h-12 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 font-black italic">P.</div>
                    </div>

                    <div class="w-full h-3 bg-slate-100 rounded-full overflow-hidden">
                        <div class="h-full bg-indigo-600 w-2/3 shadow-[0_0_10px_rgba(79,70,229,0.5)]"></div>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-6 rounded-2xl bg-slate-50 border border-slate-100 hover:scale-[1.02] transition transform">
                            <div class="flex items-center gap-4">
                                <div class="w-6 h-6 rounded-full border-2 border-indigo-600"></div>
                                <span class="font-bold text-lg text-slate-700">Finaliser le design landing page</span>
                            </div>
                            <span class="font-black text-slate-400">09:00</span>
                        </div>
                        <div class="flex items-center justify-between p-6 rounded-2xl bg-indigo-600 text-white shadow-xl shadow-indigo-100 hover:scale-[1.02] transition transform">
                            <div class="flex items-center gap-4">
                                <div class="w-6 h-6 rounded-full bg-white flex items-center justify-center">
                                    <svg class="w-4 h-4 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"/></svg>
                                </div>
                                <span class="font-bold text-lg">Lancer le projet en production</span>
                            </div>
                            <span class="font-black opacity-60">Maintenant</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="features" class="py-32 bg-slate-900 text-white relative overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="grid md:grid-cols-3 gap-16">
            <div class="group">
                <div class="w-16 h-16 bg-indigo-500 rounded-2xl flex items-center justify-center text-3xl mb-8 group-hover:-rotate-12 transition">⚡</div>
                <h3 class="text-2xl font-bold mb-4 italic">Vitesse Pure</h3>
                <p class="text-slate-400 leading-relaxed font-medium">L'interface la plus rapide que vous n'ayez jamais testée. Pas de chargement, que de l'action.</p>
            </div>
            <div class="group">
                <div class="w-16 h-16 bg-blue-500 rounded-2xl flex items-center justify-center text-3xl mb-8 group-hover:-rotate-12 transition">🧠</div>
                <h3 class="text-2xl font-bold mb-4 italic">Zéro Stress</h3>
                <p class="text-slate-400 leading-relaxed font-medium">Visualisez votre charge mentale et libérez de l'espace pour ce qui compte vraiment.</p>
            </div>
            <div class="group">
                <div class="w-16 h-16 bg-emerald-500 rounded-2xl flex items-center justify-center text-3xl mb-8 group-hover:-rotate-12 transition">💎</div>
                <h3 class="text-2xl font-bold mb-4 italic">Focus Total</h3>
                <p class="text-slate-400 leading-relaxed font-medium">Un design intentionnel pour éliminer les distractions et booster votre concentration.</p>
            </div>
        </div>
    </div>
</section>

<footer class="py-12 border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-6">
        <div class="text-xl font-black italic tracking-tighter text-slate-400">Planify.</div>
        <div class="text-slate-400 font-medium text-sm">© {{ date('Y') }} — Fait avec passion pour les bâtisseurs.</div>
        <div class="flex gap-6">
            <a href="#" class="text-slate-400 hover:text-indigo-600 transition">Twitter</a>
            <a href="#" class="text-slate-400 hover:text-indigo-600 transition">Github</a>
        </div>
    </div>
</footer>

</body>
</html>
