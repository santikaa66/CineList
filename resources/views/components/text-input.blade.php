@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-slate-900 text-white border-gray-800 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) }}>
