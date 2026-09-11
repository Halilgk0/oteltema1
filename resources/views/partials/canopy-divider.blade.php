@php
    // $color: a CSS color value (or var(--x)) painted as the torn-paper edge.
    // $flip: true to point the tear downward instead of upward.
    $color = $color ?? 'var(--paper)';
    $flip = $flip ?? false;
@endphp
<div class="torn-divider" aria-hidden="true">
    <svg viewBox="0 0 1200 60" preserveAspectRatio="none" style="color: {{ $color }}; {{ $flip ? 'transform: scaleY(-1);' : '' }}">
        <path fill="currentColor" d="M0,22 L38,36 L74,9 L112,40 L150,16 L188,46 L226,21 L268,52 L306,13 L346,39 L386,19 L426,49 L466,23 L506,43 L546,8 L586,37 L624,20 L664,47 L704,15 L744,41 L784,25 L824,51 L864,17 L904,39 L944,21 L984,45 L1024,12 L1064,37 L1104,23 L1144,47 L1200,22 L1200,60 L0,60 Z" />
    </svg>
</div>
