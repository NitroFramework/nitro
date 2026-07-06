@blaze

@props(['variant' => 'primary'])

<button class="btn btn-{{ $variant }}" {{ $attributes }}>{{ $slot }}</button>
