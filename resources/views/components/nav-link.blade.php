@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center mt-px px-2 py-1 border-b-2 border-indigo-400 text-lg font-semibold leading-5 text-slate-200 bg-gray-200 rounded-full focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
            : 'inline-flex items-center mt-px px-2 py-1 border-b-2 border-transparent text-lg font-semibold leading-5 rounded-full btn_navbar transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
