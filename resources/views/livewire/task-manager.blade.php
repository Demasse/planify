<div class="w-full max-w-2xl mx-auto px-4 py-6 sm:py-10">

    <div class="mb-8">
    <div class="flex justify-between items-end mb-2">
        <span class="text-slate-900 font-black text-sm uppercase tracking-wider">Progression</span>
        <span class="text-indigo-600 font-black text-xl">{{ $progress }}%</span>
    </div>
    <div class="w-full h-4 bg-slate-100 rounded-full overflow-hidden border border-slate-200">
        <div class="h-full bg-indigo-600 transition-all duration-500 ease-out shadow-[0_0_15px_rgba(79,70,229,0.4)]"
             style="width: {{ $progress }}%">
        </div>
    </div>
</div>

    <div class="mb-8 text-center sm:text-left">
        <h1 class="text-4xl sm:text-5xl font-extrabold text-slate-900 tracking-tighter">
            Planify<span class="text-indigo-600">.</span>
        </h1>
        <p class="text-slate-500 font-medium mt-2 text-sm sm:text-base">Gère ton temps, un bloc à la fois.</p>
    </div>

    <div class="bg-white rounded-[2rem] shadow-xl shadow-slate-200/50 p-2 mb-8 border border-slate-100">
        <form wire:submit.prevent="addTask" class="flex flex-col sm:flex-row gap-2 border border-2 border-black ">
            <input wire:model="label" type="text" placeholder="Nouvelle tâche..."
                class="flex-1 border-none bg-transparent py-4 px-6 text-slate-700 font-semibold placeholder:text-slate-400 focus:ring-0 text-lg">

            <div class="flex items-center gap-2 p-2 sm:p-0">
                <input wire:model="scheduled_at" type="time"
                    class="flex-1 sm:w-32 border-none bg-slate-50 rounded-2xl py-3 px-4 text-slate-600 font-bold focus:ring-2 focus:ring-indigo-500/20 outline-none">

                <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white p-4 rounded-2xl shadow-lg shadow-indigo-200 transition-all active:scale-95 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 group-hover:rotate-90 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" />
                    </svg>
                </button>
            </div>
        </form>
    </div>

    <div class="grid gap-3">
    @forelse($tasks as $task)
        <div class="group flex items-center justify-between p-4 sm:p-5 bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-all {{ $task->is_completed ? 'opacity-50' : '' }}">

            <div class="flex items-center gap-4 sm:gap-6 min-w-0">
                <button wire:click="toggleTask({{ $task->id }})"
                    class="flex-shrink-0 w-8 h-8 rounded-full border-2 flex items-center justify-center transition-all {{ $task->is_completed ? 'bg-emerald-500 border-emerald-500' : 'border-slate-200 hover:border-indigo-500' }}">
                    @if($task->is_completed)
                        <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                        </svg>
                    @endif
                </button>

                <div class="flex flex-col min-w-0">
                    <span class="text-xs font-black text-indigo-600 uppercase">{{ \Carbon\Carbon::parse($task->scheduled_at)->format('H:i') }}</span>
                    <span class="text-slate-700 font-bold text-lg sm:text-xl truncate {{ $task->is_completed ? 'line-through decoration-indigo-500 decoration-2' : '' }}">
                        {{ $task->label }}
                    </span>
                </div>
            </div>

            <button wire:click="deleteTask({{ $task->id }})"
                wire:confirm="Supprimer cette tâche ?"
                class="opacity-0 group-hover:opacity-100 p-2 text-slate-300 hover:text-red-500 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </button>
        </div>
    @empty
        @endforelse
</div>
</div>
