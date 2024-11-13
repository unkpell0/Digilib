@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center mt-px px-2 py-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-800 bg-gray-200 rounded-full focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
            : 'inline-flex items-center mt-px px-2 py-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-700 hover:text-gray-800 hover:bg-gray-100 hover:underline-offset-1 hover:rounded-full focus:outline-none focus:text-gray-700 focus:bg-gray-100 focus:rounded-full transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
