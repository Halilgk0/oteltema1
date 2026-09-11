{{-- Ambient rainforest layer: drifting canopy light, falling leaves, fireflies and small flying birds. Purely decorative. --}}
<div class="jungle-fx" aria-hidden="true">
    <span class="canopy-glow canopy-glow-1"></span>
    <span class="canopy-glow canopy-glow-2"></span>
    <span class="canopy-glow canopy-glow-3"></span>

    @for ($i = 0; $i < 12; $i++)
        @php
            $left = (int) fmod($i * 47 + 6, 96);
            $top = (int) fmod($i * 63 + 14, 90);
            $duration = 6 + fmod($i * 2.3, 5);
            $delay = -1 * fmod($i * 3.1, 8);
        @endphp
        <span class="firefly" style="left:{{ $left }}%; top:{{ $top }}%; animation-duration:{{ $duration }}s; animation-delay:{{ $delay }}s;"></span>
    @endfor

    @for ($i = 0; $i < 7; $i++)
        @php
            $left = (int) fmod($i * 61 + 9, 94);
            $duration = 14 + fmod($i * 3.7, 10);
            $delay = -1 * fmod($i * 5.3, 18);
            $leafColor = $i % 2 === 0 ? '#6a8850' : '#8c4322';
        @endphp
        <span class="leaf-fall" style="left:{{ $left }}%; animation-duration:{{ $duration }}s; animation-delay:{{ $delay }}s;">
            <svg viewBox="0 0 16 16"><path d="M8 0 C 13 3, 15 9, 8 16 C 1 9, 3 3, 8 0 Z" fill="{{ $leafColor }}" /></svg>
        </span>
    @endfor

    <span class="bird" style="top:14%; animation-duration:34s; animation-delay:-4s;">
        <svg viewBox="0 0 32 16" class="bird-flap"><path d="M0 8 Q8 -4 16 8 Q24 -4 32 8" fill="none" stroke="#0e130a" stroke-width="2.4" stroke-linecap="round"/></svg>
    </span>
    <span class="bird bird-sm" style="top:22%; animation-duration:46s; animation-delay:-18s;">
        <svg viewBox="0 0 32 16" class="bird-flap"><path d="M0 8 Q8 -4 16 8 Q24 -4 32 8" fill="none" stroke="#0e130a" stroke-width="2.4" stroke-linecap="round"/></svg>
    </span>
    <span class="bird" style="top:9%; animation-duration:40s; animation-delay:-27s;">
        <svg viewBox="0 0 32 16" class="bird-flap"><path d="M0 8 Q8 -4 16 8 Q24 -4 32 8" fill="none" stroke="#0e130a" stroke-width="2.4" stroke-linecap="round"/></svg>
    </span>
    <span class="bird bird-sm" style="top:27%; animation-duration:52s; animation-delay:-9s;">
        <svg viewBox="0 0 32 16" class="bird-flap"><path d="M0 8 Q8 -4 16 8 Q24 -4 32 8" fill="none" stroke="#0e130a" stroke-width="2.4" stroke-linecap="round"/></svg>
    </span>
</div>
