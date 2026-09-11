@php
    $side = $side ?? 'left';
    $frameClass = $side === 'right' ? 'canopy-frame canopy-frame-r' : 'canopy-frame';
@endphp
<svg class="{{ $frameClass }}" viewBox="0 0 420 260" aria-hidden="true" focusable="false">
    <path d="M0 0 C 60 6, 130 34, 168 88 C 196 128, 176 168, 132 176 C 176 158, 214 150, 252 168 C 212 118, 262 92, 322 100 C 282 58, 342 42, 402 54 L 420 0 Z"
          fill="#0e130a" />
    <ellipse cx="66" cy="52" rx="36" ry="21" fill="#2c4025" transform="rotate(-25 66 52)" />
    <ellipse cx="150" cy="108" rx="30" ry="18" fill="#6a8850" opacity=".85" transform="rotate(15 150 108)" />
    <ellipse cx="238" cy="66" rx="30" ry="17" fill="#2c4025" transform="rotate(-12 238 66)" />
    <ellipse cx="322" cy="38" rx="27" ry="15" fill="#6a8850" opacity=".8" transform="rotate(18 322 38)" />
    <ellipse cx="112" cy="148" rx="22" ry="13" fill="#0e130a" transform="rotate(30 112 148)" />
    <ellipse cx="30" cy="20" rx="20" ry="12" fill="#6a8850" opacity=".7" transform="rotate(-35 30 20)" />
</svg>
