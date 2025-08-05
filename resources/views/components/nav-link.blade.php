@props(['href', 'active' => false, 'icon' => 'fa-home'])

@php
    $classes = $active ? 'nav-link active' : 'nav-link';
@endphp

<li class="nav-item">
    <a href="{{ $href }}"  {{ $attributes->class([$classes]) }}>
        <i class="nav-icon bi bi-circle"></i>
        <p>{{ $slot }}</p>
    </a>
</li>
