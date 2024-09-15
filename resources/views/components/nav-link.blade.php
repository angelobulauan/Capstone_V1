@props(['active'])

@php
$classes = ($active ?? false)
    ? 'inline-flex items-center px-3 py-2 border-b-2 border-indigo-400 dark:border-indigo-600 text-lg font-semibold font-sans leading-6 text-gray-900 dark:text-gray-100 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out no-underline hover:text-black dark:hover:text-black hover:bg-blue-100 dark:hover:bg-blue-800 hover:shadow-lg transform hover:scale-105 active:text-black active:bg-transparent active:border-transparent active:scale-95'
    : 'inline-flex items-center px-3 py-2 border-b-2 border-transparent text-lg font-semibold font-sans leading-6 text-gray-500 dark:text-gray-400 hover:text-black dark:hover:text-black hover:border-blue-500 dark:hover:border-blue-400 hover:bg-blue-100 dark:hover:bg-blue-800 hover:shadow-lg transform hover:scale-105 active:text-black active:bg-transparent active:border-transparent active:scale-95 transition duration-150 ease-in-out no-underline';

@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
