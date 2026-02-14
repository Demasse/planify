@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'w-full bg-white/50 border-2 border-slate-200 rounded-2xl py-4 px-6 text-slate-700 font-semibold placeholder:text-slate-400 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 focus:bg-white transition-all duration-300 outline-none shadow-sm']) !!}>
