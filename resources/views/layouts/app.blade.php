<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">

    <div class="min-h-screen flex flex-col bg-gray-100">

        {{-- Navbar --}}
        @include('components.navbar')

        {{-- Main Area --}}
        <div class="flex flex-1">

            {{-- Sidebar --}}
            @include('components.sidebar')

            {{-- Right Side --}}
            <div class="flex-1 flex flex-col">

                {{-- Main Content --}}
                <main class="flex-1 p-6 overflow-y-auto">
                    {{ $slot }}
                </main>

            </div>

        </div>

    </div>

</body>

</html>
