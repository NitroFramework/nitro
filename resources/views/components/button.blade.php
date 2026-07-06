@php
    $color = $color ?? 'blue';
    $styles = "background: {$color}; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer;";
@endphp

<button style="{{ $styles }}">
    {{ ucfirst($action) }}
</button>