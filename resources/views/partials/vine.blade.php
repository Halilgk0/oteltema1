@php
    $side = $side ?? 'left';
    $duration = $duration ?? 5;
    $swayClass = $side === 'right' ? 'vine-sway-r' : 'vine-sway-l';
@endphp
<svg class="vine-hanger {{ $swayClass }}"
     style="animation-duration: {{ $duration }}s;"
     viewBox="0 0 60 170" aria-hidden="true" focusable="false">
    <path d="M30 0 C 12 18, 46 34, 24 54 C 4 72, 42 88, 22 108 C 6 124, 40 138, 26 158"
          fill="none" stroke="#4a5636" stroke-width="3.5" stroke-linecap="round" />
    <path d="M22 26 q12 -9 20 1 q-11 10 -20 -1" fill="#7c9a5e" />
    <path d="M27 50 q-13 -6 -17 6 q13 7 17 -6" fill="#3c5334" />
    <path d="M18 82 q12 -9 20 1 q-11 10 -20 -1" fill="#7c9a5e" />
    <path d="M24 106 q-13 -6 -17 6 q13 7 17 -6" fill="#3c5334" />
    <path d="M14 132 q12 -9 20 1 q-11 10 -20 -1" fill="#7c9a5e" />
    <circle cx="26" cy="160" r="4.5" fill="#c08a2e" />
</svg>
