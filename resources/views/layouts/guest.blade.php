<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Default title')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background: url('/images/mcu-background-image.jpg');
            backdrop-filter: brightness(70%);
        }
    </style>
</head>

<body class="antialiased">
    <!-- body layout -->
    <div
        class="min-h-screen flex sm:flex flex-col justify-center items-center sm:justify-center sm:items-center pt-6 sm:pt-0 max-sm:mx-2 max-sm:mt-auto">
        <!-- Log in/register/forgot password form layout -->
        <div
            class="bg-white w-full max-w-[520px] mt-2 px-6 py-4 shadow-lg border-4 border-gray text-black overflow-hidden max-sm:max-h-[100vh] max-sm:overflow-y-auto max-sm:relative rounded-lg max-sm:rounded-lg">
            <div class="flex items-center justify-center">
                <!-- DTO UNG LOGO KAYA HNDI NAKA CENTERALIZED BY Y-AXIS -->
                <x-application-logo class="w-8 text-gray-500" />
            </div>
            <div class="flex items-center justify-center font-bold text-2xl max-sm:text-xl mt-4 text-primary">
                MCURRS
            </div>
            {{ $slot }}
        </div>
    </div>
</body>

</html>