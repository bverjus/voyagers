@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-bleu focus:ring-bleu rounded-md shadow-sm']) !!}>
