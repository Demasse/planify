<div class="w-full max-w-2xl mx-auto px-4 py-6 sm:py-10">

    <div class="mb-12 bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm">
        <div class="flex justify-between items-end mb-4">
            <div>
                <span class="text-slate-400 font-black text-[10px] uppercase tracking-[2px]">Progression</span>
                <h3 class="text-slate-900 font-extrabold text-lg">Objectifs du jour</h3>
            </div>
            <span class="text-indigo-600 font-black text-2xl tracking-tighter">{{ $progress }}%</span>
        </div>
        <div class="w-full h-3 bg-slate-100 rounded-full overflow-hidden p-0.5 border border-slate-50">
            <div class="h-full rounded-full bg-gradient-to-r from-indigo-600 to-blue-500 transition-all duration-1000 ease-out shadow-[0_0_15px_rgba(79,70,229,0.3)]"
                 style="width: {{ $progress }}%">
            </div>
        </div>
    </div>

    <div class="mb-10 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tighter">
                Ma Liste<span class="text-indigo-600">.</span>
            </h1>
            <p class="text-slate-400 font-medium text-sm">Organise tes blocs de temps.</p>
        </div>
        <div class="w-12 h-12 bg-indigo-50 rounded-2xl flex items-center justify-center">
            <span class="text-indigo-600 font-bold">{{ count($tasks) }}</span>
        </div>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.04)] p-3 mb-10 border border-slate-100 focus-within:border-indigo-200 transition-all">
        <form wire:submit.prevent="addTask" class="flex flex-col sm:flex-row gap-2">
            <input wire:model="label" type="text" placeholder="Qu'allez-vous accomplir ?"
                class="flex-1 border-none bg-transparent py-4 px-6 text-slate-700 font-semibold placeholder:text-slate-400 focus:ring-0 text-lg">

            <div class="flex items-center gap-2 p-1 sm:p-0">
                <div class="relative flex-1 sm:w-32">
                    <input wire:model="scheduled_at" type="time"
                        class="w-full border-none bg-slate-50 rounded-2xl py-3 px-4 text-slate-600 font-bold focus:ring-2 focus:ring-indigo-500/20 outline-none appearance-none">
                </div>

                <button type="submit" wire:loading.attr="disabled"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white p-4 rounded-2xl shadow-xl shadow-indigo-100 transition-all active:scale-95 group flex items-center justify-center min-w-[56px]">

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

    <div class="grid gap-4">
    @forelse($tasks as $task)
        <div wire:key="task-{{ $task->id }}"
             class="group flex items-center justify-between p-5 bg-white rounded-[2rem] border border-slate-100 shadow-sm hover:shadow-xl hover:shadow-indigo-500/5 hover:-translate-y-1 transition-all {{ $task->is_completed ? 'bg-slate-50/50' : '' }}">

            <div class="flex items-center gap-5 min-w-0">
                <button wire:click="toggleTask({{ $task->id }})"
                    class="flex-shrink-0 w-9 h-9 rounded-2xl border-2 flex items-center justify-center transition-all duration-300 {{ $task->is_completed ? 'bg-emerald-500 border-emerald-500 shadow-lg shadow-emerald-100' : 'border-slate-200 bg-white hover:border-indigo-500' }}">
                    @if($task->is_completed)
                        <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                        </svg>
                    @endif
                </button>

                <div class="flex flex-col min-w-0">
                    <span class="text-[10px] font-black {{ $task->is_completed ? 'text-slate-400' : 'text-indigo-600' }} uppercase tracking-widest">
                        {{ \Carbon\Carbon::parse($task->scheduled_at)->format('H:i') }}
                    </span>
                    <span class="text-slate-700 font-bold text-lg sm:text-xl truncate transition-all {{ $task->is_completed ? 'line-through opacity-40' : '' }}">
                        {{ $task->label }}
                    </span>
                </div>
            </div>

            <button wire:click="deleteTask({{ $task->id }})"
                wire:confirm="Supprimer cette mission ?"
                class="opacity-0 group-hover:opacity-100 p-3 bg-red-50 text-red-500 rounded-xl hover:bg-red-500 hover:text-white transition-all transform hover:rotate-12">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </button>
        </div>
    @empty
        <div class="text-center py-20 bg-white rounded-[3rem] border border-dashed border-slate-200">
            <div class="w-20 h-20 bg-indigo-50 text-indigo-500 rounded-full flex items-center justify-center mx-auto mb-6 text-3xl">
                ✨
            </div>
            <h3 class="text-xl font-black text-slate-800 tracking-tight">C'est le calme plat...</h3>
            <p class="text-slate-400 font-medium max-w-xs mx-auto mt-2">Votre liste est vide. Planifiez quelque chose de grand aujourd'hui !</p>
        </div>
    @endforelse
    </div>
</div>
