@props([
    'name',
    'show' => false,
    'maxWidth' => '2xl',
    'position' => 'center' 
])

@php
$maxWidthClasses = [
    'sm' => 'sm:max-w-sm w-full',
    'md' => 'sm:max-w-md w-full',
    'lg' => 'sm:max-w-lg w-full',
    'xl' => 'sm:max-w-xl w-full',
    '2xl' => 'sm:max-w-2xl w-full',
][$maxWidth];
// Positioning logic
switch ($position) {
    case 'left':
        $containerClasses = 'fixed inset-y-0 left-0 overflow-y-auto px-4 py-6 sm:px-0 z-50';
        $transformHidden = 'translateX(-100%) scale(0.95)';  // Slide in from left
        break;
    case 'right':
        $containerClasses = 'fixed inset-y-0 right-0 overflow-y-auto mx-6 px-4 py-6 sm:px-0 z-50';
        $transformHidden = 'translateX(100%) scale(0.95)';  // Slide in from right
        break;
    case 'center':
    default:
        $containerClasses = 'fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50 flex items-center justify-center';
        $transformHidden = 'translateY(-1rem) scale(0.95)';  // Slide down from top for center modal
        break;
}
@endphp

<div class="{{ $containerClasses }}"  id="modal-{{ $name }}"  role="dialog"  aria-modal="true"  aria-hidden="{{ $show ? 'false' : 'true' }}" style="display: {{ $show ? 'block' : 'none' }};" >
    <div class="fixed inset-0 bg-gray-500 dark:bg-gray-900 opacity-75 transition-opacity" id="modal-backdrop-{{ $name }}"></div>

    <div 
        class="mb-6 bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full {{ $maxWidth }} sm:mx-auto"
        id="modal-content-{{ $name }}"
        tabindex="-1"
        style="
            opacity: {{ $show ? '1' : '0' }};
            transform: {{ $show ? 'translateY(0) scale(1)' : 'translateY(-100%) scale(0.95)' }};
            transition: opacity 300ms ease, transform 300ms ease;
        "
    >
        {{ $slot }}
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('modal-{{ $name }}');
    const backdrop = document.getElementById('modal-backdrop-{{ $name }}');
    const content = document.getElementById('modal-content-{{ $name }}');

    function getFocusableElements() {
        const selectors = 'a, button, input:not([type="hidden"]), textarea, select, details, [tabindex]:not([tabindex="-1"])';
        return Array.from(content.querySelectorAll(selectors))
            .filter(el => !el.hasAttribute('disabled'));
    }

    function trapFocus(e) {
        const focusable = getFocusableElements();
        if (focusable.length === 0) {
            e.preventDefault();
            return;
        }

        const first = focusable[0];
        const last = focusable[focusable.length - 1];

        if (e.key === 'Tab') {
            if (e.shiftKey) {
                // Shift + Tab
                if (document.activeElement === first) {
                    e.preventDefault();
                    last.focus();
                }
            } else {
                // Tab
                if (document.activeElement === last) {
                    e.preventDefault();
                    first.focus();
                }
            }
        } else if (e.key === 'Escape') {
            closeModal();
        }
    }

    function openModal() {
        modal.style.display = 'block';
        modal.setAttribute('aria-hidden', 'false');
        document.body.classList.add('overflow-y-hidden');
        content.style.opacity = '1';
        content.style.transform = 'translateY(0) scale(1)';
        // Focus first focusable element after opening
        const focusable = getFocusableElements();
        if (focusable.length > 0) {
            setTimeout(() => focusable[0].focus(), 100);
        } else {
            content.focus();
        }
    }

    function closeModal() {
        content.style.opacity = '0';
        content.style.transform = 'translateY(1rem) scale(0.95)';
        modal.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('overflow-y-hidden');
        setTimeout(() => {
            modal.style.display = 'none';
        }, 300); // match transition duration
    }

    // Close on backdrop click
    backdrop.addEventListener('click', closeModal);

    // Trap focus inside modal
    modal.addEventListener('keydown', trapFocus);

    // Listen for custom events to open/close modal
    window.addEventListener('open-modal', (e) => {
        if (e.detail === '{{ $name }}') {
            openModal();
        }
    });

    window.addEventListener('close-modal', (e) => {
        if (e.detail === '{{ $name }}') {
            closeModal();
        }
    });

    // If $show is true initially, open modal
    @if($show)
    openModal();
    @endif
});
</script>
