<div class="bg-white dark:bg-slate-800 p-8 rounded-[2.5rem] border border-slate-100 dark:border-slate-700 shadow-sm text-center">

   {{-- // test la bulle --}}
    {{-- <button type="button"
        x-data
        x-on:click="$dispatch('notify', { message: 'Le test fonctionne ! 🔔', type: 'success' })"
        style="background: red; color: white; padding: 10px; border-radius: 8px; margin-bottom: 20px; cursor: pointer; font-weight: bold; border: none;">
    CLIQUE ICI POUR TESTER LA BULLE
</button> --}}

    <div class="relative inline-block group" wire:key="profile-photo-uploader">

        <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-indigo-500/20 shadow-2xl mx-auto relative">

            <img src="{{ auth()->user()->getPhotoUrl() }}" class="w-full h-full object-cover">

            <div wire:loading wire:target="photo" class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center">
                <svg class="animate-spin h-8 w-8 text-white" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>
        </div>

        <label class="absolute bottom-1 right-1 bg-indigo-600 p-2.5 rounded-2xl shadow-lg cursor-pointer hover:scale-110 transition-all border-4 border-white dark:border-slate-800">
            <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>

            <input type="file" wire:model="photo" id="photo" class="hidden" accept="image/*">
        </label>
    </div>

    @error('photo')
        <p class="mt-2 text-xs text-red-500 font-bold">{{ $message }}</p>
    @enderror

    <div class="mt-6">
        <h2 class="text-xl font-black text-slate-900 dark:text-white tracking-tighter">{{ auth()->user()->name }}</h2>
        <p class="text-slate-400 dark:text-slate-500 font-medium text-sm">{{ auth()->user()->email }}</p>
    </div>

    @if(auth()->user()->profile_photo_path)
        <button wire:click="deletePhoto" class="mt-6 text-xs font-black text-red-500 uppercase tracking-widest hover:bg-red-50 dark:hover:bg-red-900/20 px-4 py-2 rounded-xl transition-all">
            Supprimer la photo
        </button>
    @endif
</div>
