@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-midium text-gray-700']) }}>
    {{ $value ?? $slot }}
</label>
