<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="icon" href="{{ asset('images/logo-dark.svg') }}">

    <!-- <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }
    </style>

</head>

<body class="antialiased h-screen overflow-hidden box-border bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
    <x-dark-mode-toggle />

    <div class="h-[calc(100vh-5rem)] m-10 flex items-stretch justify-center gap-0">

        @if (request()->routeIs('login'))
        <!-- Login left panel -->
        <div class="w-1/2 h-full bg-[#3F8CFF] text-white flex items-center justify-center flex-col rounded-l-lg">
            <div class="flex items-center justify-center py-6 gap-2">
                <img src="{{ asset('images/logo-dark.svg') }}" alt="Logo" class="w-12 h-12">
                <h3 class="text-4xl font-bold text-center">Woorkroom</h3>
            </div>

            <h3 class="text-4xl text-center pt-24">Your place to work</h3>
            <h3 class="text-4xl text-center pb-24">Plan. Create. Control</h3>

            <img src="{{ asset('images/hero-image.png') }}" alt="Hero Image" class="w-[500px] h-[373px]">
        </div>
        @elseif(request()->routeIs('register'))
        @php $currentStep = $currentStep ?? 1; @endphp

        <!-- Register left panel -->
        <div class="w-1/2 h-full bg-[#3F8CFF] text-white flex items-center justify-center flex-col rounded-l-lg">
            <div class="flex items-center justify-center py-6 gap-2">
                <img src="{{ asset('images/logo-dark.svg') }}" alt="Logo" class="w-12 h-12">
            </div>

            <div class="flex flex-col items-start justify-center space-y-6 cursor-pointer">
                @php
                $steps = [
                1 => 'Valid your phone',
                2 => 'Tell about yourself',
                3 => 'Tell about your company',
                4 => 'Invite Team Members',
                ];
                @endphp
                <h1 class="text-4xl font-bold text-center">Get Started</h1>

                @foreach ($steps as $stepNumber => $label)
                <div
                    onclick="navigateToStep({{ $stepNumber }})"
                    class="flex items-center gap-2 px-4 py-2 rounded cursor-pointer
                        {{ $currentStep === $stepNumber ? 'bg-white bg-opacity-20' : '' }}"
                    title="Go to {{ $label }}">
                    <div
                        class="w-6 h-6 rounded-full border-2
                            {{ $currentStep === $stepNumber ? 'bg-[#979797] border-gray-300' : 'border-gray-300' }}"></div>
                    <span class="font-medium text-xl">{{ $label }}</span>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Right panel where form or content is injected -->
        <div class="w-1/2 h-full bg-white dark:bg-gray-800 flex items-center justify-center flex-col p-12 rounded-r-lg">
            <div class="w-full px-12">
                {{ $slot }}
            </div>
        </div>
    </div>

    <script>
        function toggleDarkMode() {
            const html = document.documentElement;
            if (html.classList.contains('dark')) {
                html.classList.remove('dark');
                localStorage.theme = 'light';
            } else {
                html.classList.add('dark');
                localStorage.theme = 'dark';
            }
        }

        // Apply saved theme or system preference on page load
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }

        function navigateToStep(step) {
            const url = new URL(window.location.href);
            url.searchParams.set('step', step);
            window.location.href = url.toString();
        }
    </script>

    @stack('scripts')

</body>

</html>