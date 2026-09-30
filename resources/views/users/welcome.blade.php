<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <!-- Font Awesome CDN -->
        <!-- Font Awesome CDN -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />



        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
           
        @endif
    </head>
    <body>
    @include('layouts.user.navigation')
        
        @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
            <div class="lg:bg-[#3c88f8] lg:mt-20 w-full flex flex-row-reverse justify-between xl:py-20 xl:px-20">
                <img src="{{ asset('storage/24f7/carousel.jpg') }}" class="max-w-full mt-20 md:mt-0 h-auto shadow-xl shadow-gray-700/50 xl:h-96" alt="Logo">
            <div class="absolute xl:static transform h-auto w-full mt-28 md:mt-32 xl:mt-0">
                <h1 class="text-white sm:font-bold ml-3 text-lg md:text-4xl">Free Installation</h1>
                <h1 class="text-[#3c88f8] font-bold text-3xl md:text-6xl lg:text-8xl whitespace-nowrap bg-white shadow-xl pl-3 ml-10">1st 10ft.</h1>
                <p class="text-white md:mt-10 ml-10 md:ml-5 md:pl-5 md:text-lg whitespace-nowrap">Affordable & trusted aircon technician to your door.</p>
                <div class="mt-16 xl:mt-32 text-end xl:text-start xl:ml-10">
                <a href="#" class="bg-white text-[#3c88f8] mr-10 xl:mr-5 py-3 px-3 font-medium rounded-md text-lg hover:bg-[#3c88f8] border hover:border-black hover:text-white shadow-md shadow-black">Check out now!</a>
                </div>
            </div>
            
            </div>
            <!--aircon brand-->
            <header class="mt-20">
                <h1 class="text-center text-4xl font-medium text-[#3c88f8]">Available Aircon Types and Brands</h1>
                <h1 class="text-center text-lg mt-6">24f7 Air Conditioner is selling all major brands such as 
                    <a href="#" class="text-[#3c88f8] hover:underline"> Carrier</a>,
                     <a href="#" class="text-[#3c88f8] hover:underline"> Daikin</a>,
                       and <a href="#" class="text-[#3c88f8] hover:underline"> Midea</a>.</h1>
            </header>
            <div class="flex flex-col items-center space-y-10 md:space-y-0 md:flex-row place-content-center mt-5">
                <a href="#"><img src="{{ asset('storage/24f7/carrier.png') }}" alt="product"></a>
                <a href="#"><img src="{{ asset('storage/24f7/daikin.png') }}" alt="product"></a>
                <a href="#"><img src="{{ asset('storage/24f7/midea.png') }}" class="h-24" alt="product"></a>
            </div>
                <!--aircon type-->
            <div class="flex flex-col md:flex-row items-center place-content-center gap-20 my-20">
                <div>
                <a href="#"><img src="{{ asset('storage/24f7/split.png') }}" class="h-60" alt="product"></a>
                <h1 class="text-center bg-[#3c88f8] py-5 text-white font-medium text-base hover:bg-blue-500">Split Type</h1>
                </div>
                <div class="">
                <a href="#"><img src="{{ asset('storage/24f7/window.png') }}" class="h-60" alt="product"></a>
                <h1 class="text-center bg-[#3c88f8] py-5 text-white font-medium text-base hover:bg-blue-500">Window Type</h1>
                </div>
            </div>
            <!--Services-->
            <div class=" my-32 flex flex-col-reverse lg:flex-row justify-self-center">
            <img src="{{ asset('storage/24f7/klining.png') }}" class="h-96 contrast-50" alt="service">
                <div class="absolute space-y-3 flex flex-col place-content-center ml-10 my-20">
                    <h1 class="text-white text-4xl font-bold mb-3">24f7 Services</h1>
                    <a class="flex items-center gap-5"><i class="fa-solid fa-check text-xl text-[#FF7700]"></i><h1 class="text-white text-xl">Cleaning and maintenance</h1></a>
                    <a class="flex items-center gap-5"><i class="fa-solid fa-check text-xl text-[#FF7700]"></i><h1 class="text-white text-xl">Repair and part replacement</h1></a>
                    <a class="flex items-center gap-5"><i class="fa-solid fa-check text-xl text-[#FF7700]"></i><h1 class="text-white text-xl">Installation and relocation</h1></a>
                    <a class="flex items-center gap-5"><i class="fa-solid fa-check text-xl text-[#FF7700]"></i><h1 class="text-white text-xl">Dismantling</h1></a>
                    <a href="#" class="text-center text-white bg-[#3c88f8] mx-20 py-3 px-3 rounded-sm shadow-md shadow-black hover:bg-blue-500">REACH US HERE!</a>
                </div>
            <img src="{{ asset('storage/24f7/24f7.png') }}" class="h-96 bg-[#3c88f8]" alt="Logo">
            </div>
            <div class="mb-20 flex justify-self-center">
            <img src="{{ asset('storage/24f7/war.png') }}" class="md:h-[350px] contrast-50" alt="warranty">
            <div class="absolute sm:mx-6 mt-12 md:mt-28 space-y-1">
                <h1 class="text-white text-4xl font-black bg-blue-400 bg-opacity-50 shadow-md shadow-black px-5">1 YEAR COMPRESOR REPLACEMENT</h1>
                <div class="flex bg-white  shadow-sm shadow-black "><h1 class="text-2xl font-bold pl-5 md:px-48 text-blue-400 whitespace-nowrap">AND 10 MONTHS SERVICE!</h1></div>
            </div>
            
            </div>
        @endif
    </body>
    @include('layouts.user.footer')
</html>
