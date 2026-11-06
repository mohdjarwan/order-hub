@php
    $colors = [
        'pending' => 'secondary',
        'processing' => 'info',
        'completed' => 'success',
        'cancelled' => 'danger',
    ];
@endphp

<span class="badge text-bg-{{ $colors[$status] ?? 'secondary' }}">{{ ucfirst($status) }}</span>
