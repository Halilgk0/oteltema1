@php
    $map = [
        'pending' => ['Bekliyor', 'var(--mustard)'],
        'confirmed' => ['Onaylandı', 'var(--moss)'],
        'checked_in' => ['Giriş Yaptı', 'var(--teal)'],
        'checked_out' => ['Çıkış Yaptı', 'var(--stone)'],
        'cancelled' => ['İptal', 'var(--rust)'],
    ];
    [$label, $color] = $map[$status] ?? [ucwords(str_replace('_', ' ', $status)), 'var(--stone)'];
@endphp
<span class="type-stamp inline-block text-[10px] px-2 py-1 border-2 border-dashed whitespace-nowrap"
      style="border-color: {{ $color }}; color: {{ $color }};">{{ $label }}</span>
