<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Planify — Organisation intelligente</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }

        :root {
            --primary: #2D3047;
            --primary-light: #419D78;
            --secondary: #E0A458;
            --dark-bg: #1A1B2F;
            --dark-surface: #252642;
            --light-bg: #F7F5F2;
        }

        .card-shadow {
            box-shadow: 0 20px 40px -15px rgba(45, 48, 71, 0.1);
        }

        .hover-lift {
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        .hover-lift:hover {
            transform: translateY(-4px);
            box-shadow: 0 25px 50px -15px rgba(45, 48, 71, 0.2);
        }

        /* Mode sombre */
        .dark-mode {
            background-color: var(--dark-bg);
            color: #fff;
        }
        .dark-mode .dark-surface {
            background-color: var(--dark-surface);
        }
        .dark-mode .card {
            background-color: rgba(37, 38, 66, 0.7);
            border-color: rgba(255, 255, 255, 0.05);
        }
        .dark-mode .text-muted {
            color: #A0A3BD;
        }
    </style>
</head>

<body class="bg-[#F7F5F2] text-[#2D3047] antialiased transition-colors duration-300" id="body">
    <!-- Theme toggle button -->
    <button onclick="toggleTheme()" class="fixed bottom-6 right-6 z-50 w-12 h-12 bg-white rounded-full shadow-lg flex items-center justify-center hover:scale-110 transition border border-[#E0A458]/20" id="themeToggle">
        <svg class="w-5 h-5 text-[#2D3047] hidden dark-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
        </svg>
        <svg class="w-5 h-5 text-[#2D3047] light-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
        </svg>
    </button>

    <!-- Éléments décoratifs -->
    <div class="fixed top-0 left-0 w-full h-full -z-10 overflow-hidden pointer-events-none">
        <div class="absolute top-[-5%] left-[5%] w-[30%] h-[30%] rounded-full bg-[#419D78]/5 blur-[100px]"></div>
        <div class="absolute bottom-[10%] right-[0%] w-[25%] h-[25%] rounded-full bg-[#E0A458]/5 blur-[100px]"></div>
        <div class="absolute top-[40%] right-[20%] w-[20%] h-[20%] rounded-full bg-[#2D3047]/5 blur-[100px]"></div>
    </div>

    <!-- Navigation -->
    <nav class="fixed top-0 w-full z-50 bg-white/90 backdrop-blur-md border-b border-[#E0A458]/10 dark-mode:bg-[#1A1B2F]/90">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center justify-between h-20">
                <!-- Logo -->
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 bg-[#2D3047] rounded-xl flex items-center justify-center shadow-lg shadow-[#2D3047]/20">
                        <div class="w-3 h-3 bg-white rounded-sm rotate-45"></div>
                    </div>
                    <span class="font-bold text-xl tracking-tight text-[#2D3047]">Planify</span>
                </div>

                <!-- Navigation desktop -->
                <div class="hidden md:flex items-center gap-10">
                    <a href="#features" class="text-sm font-medium text-[#2D3047]/70 hover:text-[#419D78] transition relative group">
                        Fonctionnalités
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-[#419D78] transition-all group-hover:w-full"></span>
                    </a>
                    <a href="#pricing" class="text-sm font-medium text-[#2D3047]/70 hover:text-[#419D78] transition relative group">
                        Tarifs
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-[#419D78] transition-all group-hover:w-full"></span>
                    </a>
                    <a href="#about" class="text-sm font-medium text-[#2D3047]/70 hover:text-[#419D78] transition relative group">
                        À propos
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-[#419D78] transition-all group-hover:w-full"></span>
                    </a>
                </div>

                <!-- Boutons -->
                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-[#2D3047] bg-[#E0A458]/10 px-5 py-2.5 rounded-xl hover:bg-[#E0A458]/20 transition">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-[#2D3047]/70 hover:text-[#419D78] transition">Connexion</a>
                        <a href="{{ route('register') }}" class="bg-[#2D3047] text-white text-sm px-6 py-2.5 rounded-xl hover:bg-[#419D78] transition shadow-lg shadow-[#2D3047]/20">
                            Commencer
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main content -->
    <main class="pt-20">
        <!-- Hero section -->
        <div class="max-w-7xl mx-auto px-6 py-24">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <!-- Left column -->
                <div>
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#419D78]/10 text-[#419D78] text-sm font-medium mb-8">
                        <span class="w-2 h-2 rounded-full bg-[#419D78] animate-pulse"></span>
                        Nouvelle version disponible
                    </span>

                    <h1 class="text-5xl lg:text-6xl font-bold tracking-tight mb-6">
                        Organisez votre<br>
                        <span class="text-[#419D78]">travail intelligemment</span>
                    </h1>

                    <p class="text-lg text-[#2D3047]/60 mb-8 max-w-lg leading-relaxed">
                        Une plateforme conçue pour les équipes modernes.
                        Simple, élégante, efficace. Concentrez-vous sur l'essentiel.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('register') }}" class="bg-[#2D3047] text-white px-8 py-4 rounded-xl font-medium hover:bg-[#419D78] transition shadow-xl shadow-[#2D3047]/20 flex items-center justify-center gap-2 group">
                            Commencer gratuitement
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                        <a href="#demo" class="border-2 border-[#2D3047]/10 text-[#2D3047] px-8 py-4 rounded-xl font-medium hover:border-[#419D78] hover:text-[#419D78] transition flex items-center justify-center">
                            Voir la démo
                        </a>
                    </div>

                    <!-- Stats -->
                    <div class="flex gap-8 mt-12 pt-12 border-t border-[#E0A458]/20">
                        <div>
                            <div class="text-2xl font-bold text-[#2D3047]">10k+</div>
                            <div class="text-sm text-[#2D3047]/50">Utilisateurs actifs</div>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-[#2D3047]">50k+</div>
                            <div class="text-sm text-[#2D3047]/50">Tâches complétées</div>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-[#2D3047]">4.9</div>
                            <div class="text-sm text-[#2D3047]/50">Note moyenne</div>
                        </div>
                    </div>
                </div>

                <!-- Right column - Preview card -->
                <div id="demo" class="relative">
                    <div class="absolute -inset-4 bg-gradient-to-r from-[#419D78]/20 to-[#E0A458]/20 rounded-3xl blur-2xl"></div>
                    <div class="relative bg-white rounded-3xl shadow-2xl overflow-hidden border border-[#E0A458]/20">
                        <div class="h-14 bg-[#2D3047]/5 px-6 flex items-center justify-between border-b border-[#E0A458]/10">
                            <div class="flex gap-2">
                                <div class="w-3 h-3 rounded-full bg-[#E0A458]"></div>
                                <div class="w-3 h-3 rounded-full bg-[#419D78]"></div>
                                <div class="w-3 h-3 rounded-full bg-[#2D3047]"></div>
                            </div>
                            <span class="text-xs font-medium text-[#2D3047]/40">Aperçu</span>
                        </div>

                        <div class="p-8">
                            <div class="flex justify-between items-center mb-6">
                                <h3 class="font-semibold text-[#2D3047]">Aujourd'hui</h3>
                                <span class="text-xs font-medium text-[#419D78] bg-[#419D78]/10 px-3 py-1 rounded-full">3 tâches</span>
                            </div>

                            <div class="space-y-3">
                                <div class="flex items-center justify-between p-4 bg-[#F7F5F2] rounded-xl hover-lift">
                                    <div class="flex items-center gap-3">
                                        <div class="w-5 h-5 rounded border-2 border-[#419D78]"></div>
                                        <span class="font-medium text-[#2D3047]">Design review</span>
                                    </div>
                                    <span class="text-sm text-[#2D3047]/40">10:30</span>
                                </div>

                                <div class="flex items-center justify-between p-4 bg-[#F7F5F2] rounded-xl hover-lift">
                                    <div class="flex items-center gap-3">
                                        <div class="w-5 h-5 rounded border-2 border-[#E0A458]"></div>
                                        <span class="font-medium text-[#2D3047]">Team meeting</span>
                                    </div>
                                    <span class="text-sm text-[#2D3047]/40">14:00</span>
                                </div>

                                <div class="flex items-center justify-between p-4 bg-[#2D3047] text-white rounded-xl hover-lift">
                                    <div class="flex items-center gap-3">
                                        <div class="w-5 h-5 rounded border-2 border-white/30"></div>
                                        <span class="font-medium">Lancement</span>
                                    </div>
                                    <span class="text-sm text-white/60">Maintenant</span>
                                </div>
                            </div>

                            <!-- Progress bar -->
                            <div class="mt-6 pt-6 border-t border-[#E0A458]/10">
                                <div class="flex justify-between text-sm mb-2">
                                    <span class="text-[#2D3047]/60">Progression</span>
                                    <span class="font-medium text-[#419D78]">66%</span>
                                </div>
                                <div class="h-2 bg-[#F7F5F2] rounded-full overflow-hidden">
                                    <div class="h-full w-2/3 bg-[#419D78] rounded-full"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features section -->
        <section id="features" class="py-24 bg-[#2D3047] text-white relative overflow-hidden">
            <div class="absolute inset-0 opacity-5">
                <div class="absolute top-0 left-0 w-full h-full bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]"></div>
            </div>

            <div class="max-w-7xl mx-auto px-6 relative z-10">
                <div class="text-center max-w-2xl mx-auto mb-16">
                    <span class="text-[#E0A458] font-medium text-sm tracking-wider uppercase">Fonctionnalités</span>
                    <h2 class="text-4xl font-bold mt-4 mb-6">Tout ce dont vous avez besoin</h2>
                    <p class="text-white/60">Des outils puissants mais simples à utiliser</p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <div class="group bg-white/5 backdrop-blur-sm rounded-2xl p-8 border border-white/10 hover:bg-white/10 transition hover-lift">
                        <div class="w-14 h-14 bg-[#419D78] rounded-xl flex items-center justify-center text-2xl mb-6 group-hover:scale-110 transition">⚡</div>
                        <h3 class="text-xl font-semibold mb-3">Performance</h3>
                        <p class="text-white/50 leading-relaxed">Une interface rapide et réactive qui vous fait gagner un temps précieux.</p>
                    </div>

                    <div class="group bg-white/5 backdrop-blur-sm rounded-2xl p-8 border border-white/10 hover:bg-white/10 transition hover-lift">
                        <div class="w-14 h-14 bg-[#E0A458] rounded-xl flex items-center justify-center text-2xl mb-6 group-hover:scale-110 transition">🎯</div>
                        <h3 class="text-xl font-semibold mb-3">Simplicité</h3>
                        <p class="text-white/50 leading-relaxed">Une expérience utilisateur intuitive qui va droit à l'essentiel.</p>
                    </div>

                    <div class="group bg-white/5 backdrop-blur-sm rounded-2xl p-8 border border-white/10 hover:bg-white/10 transition hover-lift">
                        <div class="w-14 h-14 bg-[#2D3047] rounded-xl flex items-center justify-center text-2xl mb-6 group-hover:scale-110 transition">🔒</div>
                        <h3 class="text-xl font-semibold mb-3">Sécurité</h3>
                        <p class="text-white/50 leading-relaxed">Vos données sont protégées avec les standards les plus élevés.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="max-w-4xl mx-auto px-6 py-24 text-center">
            <div class="bg-gradient-to-br from-[#419D78]/10 to-[#E0A458]/10 rounded-3xl p-12 border border-[#E0A458]/20">
                <h2 class="text-4xl font-bold text-[#2D3047] mb-4">Prêt à commencer ?</h2>
                <p class="text-lg text-[#2D3047]/60 mb-8">Rejoignez des milliers d'utilisateurs satisfaits</p>
                <a href="{{ route('register') }}" class="inline-flex bg-[#2D3047] text-white px-8 py-4 rounded-xl font-medium hover:bg-[#419D78] transition shadow-xl shadow-[#2D3047]/20 items-center gap-2 group">
                    Créer un compte gratuit
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="border-t border-[#E0A458]/10 py-12">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-[#2D3047] rounded-lg flex items-center justify-center">
                        <div class="w-2 h-2 bg-white rounded-sm"></div>
                    </div>
                    <span class="font-semibold text-[#2D3047]">Planify</span>
                    <span class="text-sm text-[#2D3047]/40 ml-2">© 2024</span>
                </div>

                <div class="flex gap-8">
                    <a href="#" class="text-sm text-[#2D3047]/50 hover:text-[#419D78] transition">Twitter</a>
                    <a href="#" class="text-sm text-[#2D3047]/50 hover:text-[#419D78] transition">LinkedIn</a>
                    <a href="#" class="text-sm text-[#2D3047]/50 hover:text-[#419D78] transition">GitHub</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        function toggleTheme() {
            const body = document.getElementById('body');
            const darkIcons = document.querySelectorAll('.dark-icon');
            const lightIcons = document.querySelectorAll('.light-icon');

            body.classList.toggle('dark-mode');

            if (body.classList.contains('dark-mode')) {
                body.style.backgroundColor = '#1A1B2F';
                darkIcons.forEach(icon => icon.style.display = 'block');
                lightIcons.forEach(icon => icon.style.display = 'none');
            } else {
                body.style.backgroundColor = '#F7F5F2';
                darkIcons.forEach(icon => icon.style.display = 'none');
                lightIcons.forEach(icon => icon.style.display = 'block');
            }
        }
    </script>
</body>
</html>
