<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body x-data="{ cartOpen: false, mobileSearchOpen: false, mobileMenuOpen: false }">
    @include('layouts.user.navigation')
        <div class="flex flex-col sm:justify-center items-center py-[66px] md:py-48">
            <div class="w-full md:max-w-md px-6 py-5 bg-white shadow overflow-hidden sm:rounded-lg border">
                {{ $slot }}
            </div>
        </div>
    </body>
    @include('layouts.user.footer')
</html>
