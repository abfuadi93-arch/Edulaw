@props(['variant' => 'primary'])

@php
  $base = 'inline-flex items-center justify-center rounded-xl px-4 py-2 text-sm font-semibold transition';
  $styles = [
    'primary' => 'bg-navy-950 text-white hover:bg-navy-900',
    'gold'    => 'bg-gold-500 text-navy-950 hover:bg-gold-600',
    'outline' => 'border border-navy-900/20 bg-white text-navy-950 hover:bg-slate-50',
    'wa'      => 'bg-wa-500 text-white hover:brightness-95',
  ];
@endphp

<button {{ $attributes->merge(['class' => $base.' '.($styles[$variant] ?? $styles['primary'])]) }}>
  {{ $slot }}
</button>
