<x-app-layout>
    <div class="space-y-12">
        <div class="text-center sm:text-left">
            <h2 class="text-4xl font-extrabold tracking-tight text-slate-900">
                Salut, {{ explode(' ', Auth::user()->name)[0] }} ! 👋
            </h2>
            <p class="text-slate-500 font-medium mt-2 text-lg italic">Qu'est-ce qu'on accomplit aujourd'hui ?</p>
        </div>

        <div class="relative">
            @livewire('task-manager')
        </div>
    </div>
</x-app-layout>
