<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Order Complete')</title>

    <!-- Laravel Vite (Tailwind) -->
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS & Icons -->
  
    <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
        

</head>
<body>


    <!-- Page Content -->
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8 py-4">
<div class="min-h-screen flex justify-self-center pt-[300px] px-6 md:px-16 pb-[450px]">

<div class="bg-white shadow-xl rounded-lg p-10 max-w-lg text-center">
    <div class="text-green-500 mb-4">
        <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
        </svg>
    </div>
    <h1 class="text-3xl font-bold text-gray-800 mb-4">Congratulations!</h1>
    <p class="text-gray-600 mb-6">Your purchase was successful. Thank you for shopping with us!</p>
    <a href="{{ route('welcome') }}" class="inline-block px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
        Go to Home
    </a>
</div>
</div>
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


