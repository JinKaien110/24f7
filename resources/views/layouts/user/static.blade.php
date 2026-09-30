<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }} - Terms</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans">
@include('layouts.user.navigation')
    <div class="min-h-screen pt-40 pb-20 max-w-3xl mx-5 md:mx-auto">   
        @yield('content')
    </div>
</body>
@include('layouts.user.footer')
</html>
