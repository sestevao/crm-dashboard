<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <!-- <link rel="preconnect" href="https://fonts.bunny.net"> -->
        <!-- <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> -->

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            html, body {
                height: 100%;
                margin: 0;
            }
        </style>

    </head>

    <body class="nunito-sans text-gray-900 antialiased bg-[#F2F2F2] h-screen overflow-hidden box-border">
        <div class="h-[calc(100vh-5rem)] m-10 flex items-stretch justify-center gap-0">
            @if (request()->routeIs('login'))
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
                <div class="w-1/2 h-full bg-[#3F8CFF] text-white flex items-center justify-center flex-col rounded-l-lg">
                    <div class="flex items-center justify-center py-6 gap-2">
                        <img src="{{ asset('images/logo-dark.svg') }}" alt="Logo" class="w-12 h-12">
                    </div>

                    <div class="flex flex-col items-start justify-center space-y-6">
                        <div class="flex items-center justify-center gap-2">
                            <div class="w-6 h-6 rounded-full bg-[#979797] border-2 border-gray-300"></div>
                            <span class="font-medium text-xl">Valid your phone</span>
                        </div>

                        <div class="flex items-center justify-center gap-2">
                            <div class="w-6 h-6 rounded-full border-2 border-gray-300"></div>
                            <span class="font-medium text-xl">Tell about yourself</span>
                        </div>

                        <div class="flex items-center justify-center gap-2">
                            <div class="w-6 h-6 rounded-full border-2 border-gray-300"></div>
                            <span class="font-medium text-xl">Tell about your company</span>
                        </div>

                        <div class="flex items-center justify-center gap-2">
                            <div class="w-6 h-6 rounded-full border-2 border-gray-300"></div>
                            <span class="font-medium text-xl">Invite Team Members</span>
                        </div>
                    </div>
                </div>
            @endif

            <div class="w-1/2 h-full bg-white flex items-center justify-center flex-col p-12 rounded-r-lg">
                <div class="w-full px-12">
                    {{ $slot }}
                </div>
            </div>
        </div>  
    </body>

</html>
