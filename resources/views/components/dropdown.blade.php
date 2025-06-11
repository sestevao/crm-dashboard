@props([
    'align' => 'right', 
    'width' => '48', 
    'contentClasses' => 'py-1 bg-white dark:bg-gray-700',
    'direction' => 'down',
])

@php
$alignmentClasses = match ($align) {
    'left' => 'ltr:origin-top-left rtl:origin-top-right start-0',
    'top' => 'origin-top',
    default => 'ltr:origin-top-right rtl:origin-top-left end-0',
};

$widthClass = match ($width) {
    '48' => 'w-48',
    default => $width,
};

$directionClasses = $direction === 'up'  ? 'bottom-full mb-2'  : 'top-full mt-2';
@endphp

@php
// Unique id for this dropdown instance to handle multiple dropdowns on the page
$dropdownId = 'dropdown-' . uniqid();
@endphp

<div class="relative" id="{{ $dropdownId }}">
    <div class="cursor-pointer" id="{{ $dropdownId }}-trigger">
        {{ $trigger }}
    </div>

    <div 
        id="{{ $dropdownId }}-menu"
        class="absolute z-50 {{ $widthClass }} rounded-md shadow-lg {{ $alignmentClasses }} {{ $directionClasses }} transition-opacity duration-200 ease-in-out opacity-0 scale-95 pointer-events-none"
        style="transform-origin: top right;"
        aria-hidden="true"
    >
        <div class="rounded-md ring-1 ring-black ring-opacity-5 {{ $contentClasses }}">
            {{ $content }}
        </div>
    </div>

    <script>
        (function() {
            const dropdown = document.getElementById('{{ $dropdownId }}');
            const trigger = document.getElementById('{{ $dropdownId }}-trigger');
            const menu = document.getElementById('{{ $dropdownId }}-menu');

            let open = false;

            function openMenu() {
                open = true;
                menu.style.opacity = '1';
                menu.style.transform = 'scale(1)';
                menu.style.pointerEvents = 'auto';
                menu.setAttribute('aria-hidden', 'false');
            }

            function closeMenu() {
                open = false;
                menu.style.opacity = '0';
                menu.style.transform = 'scale(0.95)';
                menu.style.pointerEvents = 'none';
                menu.setAttribute('aria-hidden', 'true');
            }

            trigger.addEventListener('click', function(event) {
                event.stopPropagation();
                if (open) {
                    closeMenu();
                } else {
                    openMenu();
                }
            });

            // Close when clicking outside the dropdown
            document.addEventListener('click', function(event) {
                if (!dropdown.contains(event.target)) {
                    closeMenu();
                }
            });

            // Optional: close when clicking inside the menu (like your @click="open = false")
            menu.addEventListener('click', function() {
                closeMenu();
            });
        })();
    </script>
</div>
