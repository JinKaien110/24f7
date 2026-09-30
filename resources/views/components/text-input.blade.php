@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-500 focus:outline-none focus:ring-0 rounded-md']) }}>
