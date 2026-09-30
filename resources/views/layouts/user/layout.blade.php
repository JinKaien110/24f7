<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>

    <!-- Laravel Vite (Tailwind) -->
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS & Icons -->
  
    <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
        

</head>
<body>
    @include('layouts.user.navigation')

    <!-- Page Content -->
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8 py-4">
                @yield('content')
                @yield('scripts')
            </div>
        </div>
    </div>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/user-orders.js') }}" defer></script>
<script src="{{ asset('js/cart.js') }}" defer></script>
<script src="//unpkg.com/alpinejs" defer></script>


</body>

</body>
</html>
