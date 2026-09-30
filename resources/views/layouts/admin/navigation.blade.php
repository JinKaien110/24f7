<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin')</title>

    <!-- Laravel Vite (Tailwind) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="{{ asset('js/admin-product.js') }}" defer></script>

    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">


    <!-- In your layout.blade.php or head -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="//unpkg.com/alpinejs" defer></script>
<!-- Before the closing </body> tag -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Add in <head> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-o8CzxqEuKq6UCh5Go...==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstrap CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body class="bg-light">

<!-- Mobile Navbar with Sidebar Toggle -->
<nav class="navbar navbar-dark bg-dark d-md-none">
    <div class="container-fluid">
        <button class="btn btn-outline-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar">
            <i class="bi bi-list"></i>
        </button>
        <a class="navbar-brand ms-2" href="#">Admin Panel</a>
    </div>
</nav>

<!-- Offcanvas Sidebar (Responsive) -->
<div class="offcanvas offcanvas-start d-md-none bg-dark text-white" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="sidebarLabel">Menu</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0">
        @include('layouts.admin.sidebar')
    </div>
</div>

<!-- Desktop Sidebar -->
<div class="d-none d-md-flex flex-column flex-shrink-0 p-3 bg-dark text-white position-fixed"
     style="width: 250px; height: 100vh; overflow-y: auto; left: 0; top: 0;">
    @include('layouts.admin.sidebar')
</div>

<!-- Page Content -->
<div class="container-fluid" style="margin-left: 0; padding-top: 1rem; padding-bottom: 2rem;">
    <div class="row">
        <div class="col-md-9 col-lg-10 offset-md-3 offset-lg-2 mt-3 mt-md-0">
            @yield('content')
            @yield('scripts')
        </div>
    </div>
</div>

<!-- Bootstrap JS (Place at bottom for faster load) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
