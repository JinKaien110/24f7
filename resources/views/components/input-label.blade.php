@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm tex-black']) }}>
    {{ $value ?? $slot }}
</label>
