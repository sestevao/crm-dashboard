<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('images/logo-dark.svg') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <!-- <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
    <div class="min-h-screen bg-[#F4F9FD] dark:bg-gray-900 flex p-6">
        <div class="h-[calc(100vh-6rem)] overflow-y-auto">
            @include('layouts.navigation')
        </div>

        <!-- Main Content Area -->
        <x-dark-mode-toggle class="mt-10 pt-10" />

        <div class="flex-1 flex flex-col max-h-screen ml-64">
            @isset($header)
            <header class="my-10">
                {{ $header }}
            </header>
            @endisset

            <main class="flex-1 py-6">
                {{ $slot }}
            </main>
        </div>
    </div>

    <!-- Dark Mode Script (global) -->
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

        // On load, apply saved theme or system preference
        if (localStorage.theme === 'dark' ||
            (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    @stack('scripts')
</body>

</html>