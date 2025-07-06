@php
    $priority = strtolower($priority ?? 'medium');
@endphp

<div class="{{ $priority === 'high' ? 'text-red-500' :  ($priority === 'medium' ? 'text-yellow-400' : 'text-green-500') }} flex items-center justify-center">
    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        @if($priority === 'high')
            <path d="M12 4l6 8h-12z" fill="currentColor" />
        @elseif($priority === 'low')
            <path d="M12 20l-6-8h12z" fill="currentColor" />
        @else
            <path d="M4 12h16" stroke="currentColor" stroke-width="2" />
        @endif
    </svg>
</div>
