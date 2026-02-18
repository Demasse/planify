<div class="relative min-h-screen transition-colors duration-500">
    <div class="w-full max-w-2xl mx-auto px-4 py-6 sm:py-10">

        {{-- <div class="flex justify-end mb-4">
            <button onclick="document.documentElement.classList.toggle('dark')"
                class="p-3 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl shadow-sm hover:scale-110 transition-all group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500 hidden dark:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-700 block dark:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                </svg>
            </button>
        </div> --}}
<div class="flex items-center justify-between mb-8 bg-white dark:bg-slate-800 p-2 rounded-3xl border border-slate-100 dark:border-slate-700 shadow-sm">
    <button wire:click="previousDay()" class="p-3 hover:bg-slate-50 dark:hover:bg-slate-700 rounded-2xl transition-all text-slate-400">
        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7" /></svg>
    </button>

    <div class="text-center cursor-pointer" wire:click="goToToday()">
        <h2 class="text-slate-900 dark:text-white font-black tracking-tight">
            {{ \Carbon\Carbon::parse($selectedDate)->isToday() ? "Aujourd'hui" : (\Carbon\Carbon::parse($selectedDate)->isTomorrow() ? "Demain" : \Carbon\Carbon::parse($selectedDate)->translatedFormat('d F')) }}
        </h2>
        <p class="text-[10px] text-indigo-600 dark:text-indigo-400 font-black uppercase tracking-widest">
            {{ \Carbon\Carbon::parse($selectedDate)->translatedFormat('l') }}
        </p>
    </div>

    <button wire:click="nextDay()" class="p-3 hover:bg-slate-50 dark:hover:bg-slate-700 rounded-2xl transition-all text-slate-400">
        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" /></svg>
    </button>
</div>
        <div class="mb-12 bg-white dark:bg-slate-800 p-6 rounded-[2rem] border border-slate-100 dark:border-slate-700 shadow-sm transition-colors">
            <div class="flex justify-between items-end mb-4">
                <div>
                    <span class="text-slate-400 dark:text-slate-500 font-black text-[10px] uppercase tracking-[2px]">Progression</span>
                    <h3 class="text-slate-900 dark:text-white font-extrabold text-lg">Objectifs du jour</h3>
                </div>
                <span class="text-indigo-600 dark:text-indigo-400 font-black text-2xl tracking-tighter">{{ $progress }}%</span>
            </div>
            <div class="w-full h-3 bg-slate-100 dark:bg-slate-700 rounded-full overflow-hidden p-0.5 border border-slate-50 dark:border-slate-800">
                <div class="h-full rounded-full bg-gradient-to-r from-indigo-600 to-blue-500 transition-all duration-1000 ease-out shadow-[0_0_15px_rgba(79,70,229,0.3)]"
                     style="width: {{ $progress }}%">
                </div>
            </div>
        </div>

        <div class="mb-10 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tighter">
                    Ma Liste<span class="text-indigo-600">.</span>
                </h1>
                <p class="text-slate-400 dark:text-slate-500 font-medium text-sm">Organise tes blocs de temps.</p>
            </div>
            <div class="w-12 h-12 bg-indigo-50 dark:bg-indigo-900/30 rounded-2xl flex items-center justify-center">
                <span class="text-indigo-600 dark:text-indigo-400 font-bold">{{ count($tasks) }}</span>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-800 rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.04)] p-3 mb-8 border border-slate-100 dark:border-slate-700 focus-within:border-indigo-200 dark:focus-within:border-indigo-500 transition-all">
            <form wire:submit.prevent="addTask" class="flex flex-col sm:flex-row gap-2">
                <input wire:model="label" type="text" placeholder="Qu'allez-vous accomplir ?"
                    class="flex-1 border-none bg-transparent py-4 px-6 text-slate-700 dark:text-slate-200 font-semibold placeholder:text-slate-400 focus:ring-0 text-lg">

                <div class="flex items-center gap-2 p-1 sm:p-0">
                    <div class="relative flex-1 sm:w-32">
                        <input wire:model="scheduled_at" type="time"
                            class="w-full border-none bg-slate-50 dark:bg-slate-700 rounded-2xl py-3 px-4 text-slate-600 dark:text-slate-200 font-bold focus:ring-2 focus:ring-indigo-500/20 outline-none appearance-none">
                    </div>

                    <button type="submit" wire:loading.attr="disabled"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white p-4 rounded-2xl shadow-xl shadow-indigo-100 dark:shadow-none transition-all active:scale-95 group flex items-center justify-center min-w-[56px]">
                        <svg wire:loading.remove xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 group-hover:rotate-90 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" />
                        </svg>
                        <svg wire:loading class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
   <div class="relative mb-6 group">
    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
        <svg class="h-5 w-5 text-slate-400 group-focus-within:text-indigo-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
    </div>
    <input wire:model.live.debounce.300ms="search" type="text"
        placeholder="Rechercher une mission..."
        class="block w-full pl-12 pr-4 py-4 bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 rounded-2xl text-sm font-bold placeholder:text-slate-400 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all shadow-sm">

    @if(!empty($search))
        <button wire:click="$set('search', '')" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-red-500">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    @endif
</div>
        <div class="flex gap-2 mb-6 bg-slate-100 dark:bg-slate-900/50 p-1.5 rounded-2xl w-fit">
            <button wire:click="$set('filter', 'all')"
                class="px-5 py-2 rounded-xl text-xs font-black uppercase tracking-widest transition-all {{ $filter === 'all' ? 'bg-white dark:bg-slate-700 text-indigo-600 dark:text-white shadow-sm' : 'text-slate-500 hover:text-slate-700 dark:hover:text-slate-300' }}">
                Toutes
            </button>
            <button wire:click="$set('filter', 'todo')"
                class="px-5 py-2 rounded-xl text-xs font-black uppercase tracking-widest transition-all {{ $filter === 'todo' ? 'bg-white dark:bg-slate-700 text-indigo-600 dark:text-white shadow-sm' : 'text-slate-500 hover:text-slate-700 dark:hover:text-slate-300' }}">
                À faire
            </button>
            <button wire:click="$set('filter', 'completed')"
                class="px-5 py-2 rounded-xl text-xs font-black uppercase tracking-widest transition-all {{ $filter === 'completed' ? 'bg-white dark:bg-slate-700 text-indigo-600 dark:text-white shadow-sm' : 'text-slate-500 hover:text-slate-700 dark:hover:text-slate-300' }}">
                Faites
            </button>
        </div>

   <div class="grid gap-4">
    @forelse($tasks as $task)
        <div wire:key="task-{{ $task->id }}"
             class="group flex items-center justify-between p-5 bg-white dark:bg-slate-800 rounded-[2rem] border border-slate-100 dark:border-slate-700 shadow-sm hover:shadow-xl hover:shadow-indigo-500/5 dark:hover:shadow-indigo-500/10 hover:-translate-y-1 transition-all {{ $task->is_completed ? 'bg-slate-50/50 dark:bg-slate-800/40' : '' }}">

            <div class="flex items-center gap-5 min-w-0">
                <button wire:click="toggleTask({{ $task->id }})"
                    class="flex-shrink-0 w-9 h-9 rounded-2xl border-2 flex items-center justify-center transition-all duration-300 {{ $task->is_completed ? 'bg-emerald-500 border-emerald-500 shadow-lg shadow-emerald-100 dark:shadow-none' : 'border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-700 hover:border-indigo-500' }}">
                    @if($task->is_completed)
                        <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                        </svg>
                    @endif
                </button>

                <div class="flex flex-col min-w-0">
                    <span class="text-[10px] font-black {{ $task->is_completed ? 'text-slate-400 dark:text-slate-600' : 'text-indigo-600 dark:text-indigo-400' }} uppercase tracking-widest">
                        {{ \Carbon\Carbon::parse($task->scheduled_at)->format('H:i') }}
                    </span>
                    <span class="text-slate-700 dark:text-slate-200 font-bold text-lg sm:text-xl truncate transition-all {{ $task->is_completed ? 'line-through opacity-40' : '' }}">
                        {{ $task->label }}
                    </span>
                </div>
            </div>

            <button wire:click="deleteTask({{ $task->id }})"
                wire:confirm="Supprimer cette mission ?"
                class="opacity-0 group-hover:opacity-100 p-3 bg-red-50 dark:bg-red-900/20 text-red-500 rounded-xl hover:bg-red-500 hover:text-white transition-all transform hover:rotate-12">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </button>
        </div>
    @empty
        <div class="text-center py-20 bg-white dark:bg-slate-800 rounded-[3rem] border border-dashed border-slate-200 dark:border-slate-700 transition-colors">
            <div class="w-20 h-20 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-500 dark:text-indigo-400 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl">
                ✨
            </div>
            <h3 class="text-xl font-black text-slate-800 dark:text-white tracking-tight">C'est le calme plat...</h3>
            <p class="text-slate-400 dark:text-slate-500 font-medium max-w-xs mx-auto mt-2">Aucune tâche pour le moment.</p>
        </div>
    @endforelse
</div>

    <div x-data="{ show: false, message: '', timeout: null }"
        x-on:notify.window="show = true; message = $event.detail.message; clearTimeout(timeout); timeout = setTimeout(() => show = false, 3000)"
        x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-10"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed bottom-10 left-1/2 -translate-x-1/2 z-50"
        style="display: none;">

        <div class="bg-slate-900 dark:bg-white text-white dark:text-slate-900 px-6 py-3 rounded-full shadow-2xl flex items-center gap-3 border border-white/10 dark:border-slate-200">
            <div class="w-2 h-2 bg-indigo-500 rounded-full animate-pulse"></div>
            <span class="text-sm font-bold tracking-wide" x-text="message"></span>
        </div>
    </div>
</div>
