<div class="p-4 sm:p-6 bg-slate-50 dark:bg-slate-900 min-h-screen rounded-[2.5rem]">
    <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-8">

        <div class="lg:col-span-2 space-y-6">

            <div class="bg-indigo-600 p-8 rounded-[2.5rem] text-white shadow-xl shadow-indigo-200 dark:shadow-none transition-transform hover:scale-[1.01]">
                <p class="text-indigo-100 text-sm font-bold uppercase tracking-[0.2em]">Planning du</p>
                <h3 class="text-3xl font-black mt-1">
                    {{ \Carbon\Carbon::parse($selectedDate)->translatedFormat('d F') }}
                </h3>
            </div>

            <div class="bg-white dark:bg-slate-800 p-8 rounded-[2.5rem] shadow-sm border border-slate-100 dark:border-slate-700">

                <div class="flex items-center justify-between mb-10">
                    <h2 class="text-2xl font-black text-slate-900 dark:text-white tracking-tighter">
                        {{ ucfirst($monthName) }}
                    </h2>
                    <div class="flex space-x-3">
                        <button wire:click="previousMonth" class="p-3 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-2xl transition-all border border-slate-50 dark:border-slate-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                        </button>
                        <button wire:click="nextMonth" class="p-3 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-2xl transition-all border border-slate-50 dark:border-slate-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-7 gap-1 mb-6">
                    @foreach(['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'] as $dayName)
                        <div class="text-center text-[10px] font-black text-slate-400 uppercase tracking-[0.15em] p-2">
                            {{ $dayName }}
                        </div>
                    @endforeach
                </div>

                <div class="grid grid-cols-7 gap-3">
                    @foreach($days as $day)
                        <button
                            wire:click="selectDate('{{ $day['full'] }}')"
                            class="relative aspect-square flex flex-col items-center justify-center rounded-[1.5rem] transition-all border-2 text-sm font-bold
                            {{ $selectedDate == $day['full']
                                ? 'bg-indigo-600 border-indigo-600 text-white shadow-lg shadow-indigo-100 dark:shadow-none scale-110 z-10'
                                : 'bg-transparent border-transparent hover:bg-indigo-50 dark:hover:bg-indigo-900/30 text-slate-700 dark:text-slate-300 hover:scale-105' }}
                            {{ $day['isToday'] && $selectedDate != $day['full'] ? 'border-indigo-100 dark:border-indigo-800 text-indigo-600' : '' }}">

                            {{ $day['day'] }}

                            @if($day['isToday'])
                                <span class="absolute bottom-2 w-1.5 h-1.5 {{ $selectedDate == $day['full'] ? 'bg-white' : 'bg-indigo-600' }} rounded-full"></span>
                            @endif
                        </button>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="lg:col-span-1">
            </div>

    </div>
</div>
