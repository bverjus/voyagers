@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex h-[2.5em] items-center  px-1 pt-1 border-b-2 border-bleu text-md font-medium leading-5 text-gray-900 font-bold focus:outline-none focus:border-bleu transition duration-150 ease-in-out'
            : 'flex  h-[2.5em] items-center px-1 pt-1 border-b-2 border-transparent text-md font-medium leading-5 text-gray-900 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
