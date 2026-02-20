<x-app-layout>
    <div class="space-y-8 p-4">
        <div class="text-center sm:text-left">
            <h2 class="text-4xl font-extrabold tracking-tight text-slate-900 dark:text-white">
                Salut, {{ explode(' ', Auth::user()->name)[0] }} ! 👋
            </h2>
            <p class="text-slate-500 font-medium mt-2 text-lg italic">Qu'est-ce qu'on accomplit aujourd'hui ?</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">

            <div class="w-full">
                <div class="sticky top-6">
                    @livewire('task-calendar')
                </div>
            </div>

            <div class="w-full space-y-6">

                {{-- <div class="bg-white dark:bg-slate-800 p-8 rounded-[2.5rem] shadow-sm border border-slate-100 dark:border-slate-700">
                    <div class="flex justify-between items-end mb-4">
                        <div>
                            <h4 class="text-xs font-black uppercase tracking-[0.2em] text-slate-400">Progression</h4>
                            <p class="text-2xl font-black text-slate-900 dark:text-white">Focus du jour</p>
                        </div>
                        <span class="text-indigo-600 font-black text-xl">65%</span>
                    </div>

                    <div class="w-full bg-slate-100 dark:bg-slate-700 h-3 rounded-full overflow-hidden">
                        <div class="bg-indigo-600 h-full rounded-full transition-all duration-1000 shadow-[0_0_15px_rgba(79,70,229,0.3)]" style="width: 65%"></div>
                    </div>
                </div> --}}

                <div class="bg-white dark:bg-slate-800 p-4 rounded-[2.5rem] shadow-sm border border-slate-100 dark:border-slate-700">
                    @livewire('task-manager')
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
