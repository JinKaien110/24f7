@extends('layouts.user.dev')

@section('content')
<div class="fixed bottom-8 right-8"><a href="javascript:history.back()">
    <i class="fa-solid fa-circle-left text-6xl rounded-full bg-white hover:bg-green-700"></a></i></div>

<img src="{{ asset('storage/24f7/bg.jpg') }}" class="h-auto w-full shadow-xl shadow-gray-700/50">
<h1 class="absolute top-14 left-20 text-white text-6xl font-bold shadow shadow-black">Para kameng tanga dito</h1>
<div class="text-center mt-10">
    <h1 class="font-bold text-3xl">ABOUT THE DEVELOPER</h1>
    <p class="xl:text-xl">We are students of Kolehiyo ng Lungsod ng Dasmariñas, pursuing a Bachelor of Science in Information Systems.
        <br>This project was proposed during the 2024-2025 academic year.
    </p>
</div>

<main class="flex flex-col xl:flex-row gap-20 place-content-center mt-48 max-w-full h-auto">
    <div class="flex flex-col md:flex-row gap-20 place-content-center">
    <div class="items-center flex flex-col">
    <img src="{{ asset('storage/24f7/mekk.png') }}" class="size-32 rounded-full shadow-xl shadow-gray-700/50" alt="Logo">
    <h1 class=" text-xl font-black mt-5">Dungo, Francois Mekadesh L.</h1>
    <div class="flex items-center">
        <i class="fa-brands fa-facebook text-3xl mr-2"></i>
        <a href="https://www.facebook.com/mekadesh.dungo#" class="hover:underline">/mekadesh.dungo</a>
    </div>
    </div>
    <div class="items-center flex flex-col">
    <img src="{{ asset('storage/24f7/shin.jpg') }}" class="size-32 rounded-full shadow-xl shadow-gray-700/50" alt="Logo">
    <h1 class=" text-xl font-black mt-5">Gonzaga, Michael G.</h1>
    <div class="flex items-center">
        <i class="fa-brands fa-facebook text-3xl mr-2"></i>
        <a href="https://www.facebook.com/JinKaien110" class="hover:underline">/JinKaien110</a>
        </div>
    </div>
    </div>

    <div class="flex flex-col md:flex-row gap-20 place-content-center">
    <div class="items-center flex flex-col">
    <img src="{{ asset('storage/24f7/mich.jpg') }}" class="size-32 rounded-full shadow-xl shadow-gray-700/50" alt="Logo">
    <h1 class=" text-xl font-black mt-5">Toquero, Michelle Q.</h1>
    <div class="flex items-center">
        <i class="fa-brands fa-facebook text-3xl mr-2"></i>
        <a href="https://www.facebook.com/michelle.toquero.94" class="hover:underline">/michelle.toquero.94</a>
        </div>
    </div>
    <div class="items-center flex flex-col">
    <img src="{{ asset('storage/24f7/har.jpg') }}" class="size-32 rounded-full shadow-xl shadow-gray-700/50" alt="Logo">
    <h1 class=" text-xl font-black mt-5">Pineda, Harry P.</h1>
    <div class="flex items-center">
        <i class="fa-brands fa-facebook text-3xl mr-2"></i>
        <a href="https://www.facebook.com/aryart06" class="hover:underline">/aryart06</a>
        </div>
    </div>
    <div class="items-center flex flex-col">
    <img src="{{ asset('storage/24f7/rey.jpg') }}" class="size-32 rounded-full shadow-xl shadow-gray-700/50" alt="Logo">
    <h1 class=" text-xl font-black mt-5">Ruiz, Reynaldo Jr, S.</h1>
    <div class="flex items-center">
        <i class="fa-brands fa-facebook text-3xl mr-2"></i>
        <a href="https://www.facebook.com/dagszky" class="hover:underline">/dagszky</a>
        </div>
    </div>
    </div>
   
    </main>
    <footer class="mt-32 ml-20">
            Copyright 2025. All Rights Reserved.
    </footer>
@endsection