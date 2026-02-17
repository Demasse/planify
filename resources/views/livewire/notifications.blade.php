<div> <div x-data="{
            open: false,
            message: '',
            type: 'success',
            init() {
                @if(session()->has('notify'))
                    this.showNotification(@json(session('notify')));
                @endif
            },
            showNotification(data) {
                this.message = data.message;
                this.type = data.type || 'success';
                this.open = true;

                let audio = new Audio('/sounds/ding.mp3');
                audio.play().catch(e => console.log('Audio bloqué'));

                setTimeout(() => { this.open = false }, 4000);
            }
         }"
         x-on:notify.window="showNotification($event.detail)"
         class="fixed bottom-6 right-6 z-[100] pointer-events-none">

        <div x-show="open"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             :class="type === 'success' ? 'bg-indigo-600' : 'bg-red-500'"
             class="pointer-events-auto flex items-center gap-3 px-6 py-4 rounded-2xl shadow-2xl text-white border border-white/20 backdrop-blur-md">

            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span x-text="message" class="font-bold"></span>
        </div>
    </div>

</div> ```


