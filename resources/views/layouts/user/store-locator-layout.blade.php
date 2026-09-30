<!-- This is a custom layout just for Store Locator -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Store Locator</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- load styles & scripts -->
    <script src="//unpkg.com/alpinejs" defer></script>
    
</head>
<body class="bg-white text-gray-800">
@include('layouts.user.navigation')
    <!-- You can adjust this container however you want -->
    <main class="min-h-screen flex flex-col md:mx-32 justify-self-center pb-5  md:py-32">
        @yield('content')<!-- this is where your page content goes -->
    </main>
</body>
@include('layouts.user.footer')
</html>
