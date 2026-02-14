<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Planify — Connexion</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        <style>
            body { font-family: 'Plus Jakarta Sans', sans-serif; }

            /* Effet Verre (Glassmorphism) amélioré */
            .glass {
                background: rgba(255, 255, 255, 0.75);
                backdrop-filter: blur(16px);
                -webkit-backdrop-filter: blur(16px);
            }

            /* --- STYLE DES INPUTS --- */
            input {
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            }

            /* Animation quand on clique dans un champ */
            input:focus {
                transform: translateY(-2px);
                box-shadow: 0 10px 20px -5px rgba(79, 70, 229, 0.15) !important;
            }

            /* --- STYLE DES BOUTONS (Le fameux bouton Waouh) --- */
            .btn-expert {
                background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                position: relative;
                overflow: hidden;
            }

            .btn-expert:hover {
                filter: brightness(1.1);
                transform: translateY(-3px) scale(1.02);
                box-shadow: 0 20px 30px -10px rgba(79, 70, 229, 0.4);
            }

            .btn-expert:active {
                transform: translateY(0) scale(0.98);
            }

            /* Animation d'entrée pour la carte */
            .fade-in-card {
                animation: slideUp 0.6s ease-out;
            }

            @keyframes slideUp {
                from { opacity: 0; transform: translateY(30px); }
                to { opacity: 1; transform: translateY(0); }
            }
        </style>
    </head>
    <body class="bg-[#f8fafc] antialiased text-slate-900 overflow-x-hidden">

        <div class="fixed top-0 left-1/2 -translate-x-1/2 w-full h-full -z-10 overflow-hidden pointer-events-none">
            <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] rounded-full bg-indigo-100/50 blur-[120px]"></div>
            <div class="absolute bottom-[10%] right-[-5%] w-[30%] h-[30%] rounded-full bg-blue-100/50 blur-[100px]"></div>
        </div>

        <div class="min-h-screen flex flex-col justify-center items-center p-4 sm:p-0">
            <div class="mb-8 hover:scale-105 transition-transform duration-300">
                <a href="/" class="text-3xl font-black tracking-tighter flex items-center gap-3">
                    <div class="w-12 h-12 bg-indigo-600 rounded-2xl flex items-center justify-center shadow-2xl shadow-indigo-200 rotate-3 hover:rotate-0 transition-all">
                        <div class="w-5 h-5 bg-white rounded-sm rotate-45 text-indigo-600"></div>
                    </div>
                    <span class="bg-clip-text text-transparent bg-gradient-to-r from-slate-900 to-slate-600">Planify</span>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-2 px-8 py-10 glass border border-white/50 shadow-[0_40px_80px_-15px_rgba(0,0,0,0.1)] rounded-[3rem] fade-in-card">
                {{ $slot }}
            </div>

            <p class="mt-8 text-slate-400 text-sm font-bold tracking-widest uppercase opacity-60">
                &copy; {{ date('Y') }} — Crafted for productivity
            </p>
        </div>
    </body>
</html>
