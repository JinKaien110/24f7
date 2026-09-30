@extends('layouts.user.store-locator-layout')

@section('content')
<h1 class="mt-20 text-center md:mb-5 font-medium text-lg hidden md:block">VISIT OUR STORE</h1>
<div class="mt-28 md:mt-0 flex flex-col lg:flex-row space-y-5 lg:space-y-0   lg:justify-self-auto">
    <div class="flex flex-col-reverse md:flex-col rounded-md border border-gray-400 w-full md:w-[750px] mr-5">
        <aside class="ml-20 mt-20 mb-60">
            <h1 class="font-black text-xl pb-2">CONTACT PERSON</h1>
            <div class="flex items-center gap-2"><i class="fa-solid fa-user-tie text-[24px] text-[#FF7700]"></i>
            <h1 class="whitespace-nowrap font-medium text-lg">Gabriel Dungo</h1></div>
            <h1 class="ml-8">Proprietor, HVC-2486</h1>
            <h1 class="font-black text-xl pt-4 pb-1">CAVITE</h1>
            <div class="flex items-center gap-2"><i class="fa-solid fa-location-dot text-[24px] text-[#FF7700]"></i><h1 class="my-1">Belguim Road.
                Country Meadows Subdivision,
                General Trias Cavite</h1></div>
            <div class="flex items-center gap-2"><i class="fa-solid fa-phone text-[24px] text-[#FF7700]"></i><h1 class="my-1">+63 930 080 6463</h1></div>
            <h1 class=" ml-8">+63 916-342-1155</h1>
            <div class="flex items-center gap-2"><i class="fa-solid fa-envelope text-[24px] text-[#FF7700]"></i><h1>24f7@gmax.com</h1></div>
        </aside>
        <div class="w-full bg-blue-400 flex items-center gap-2">
        <img src="{{ asset('storage/24f7/24f7.png') }}" class="h-[100px] xl:h-32 mt-2 ml-16" alt="Image">
        <h2 class="text-white font-extrabold text-3xl md:text-4xl">STORE LOCATOR</h2>
        </div>
    </div>
    <iframe
        class="w-full md:w-[750px] md:h-[700px] rounded-md shadow-md border border-gray-4"
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d981.0129030198971!2d120.919526829558!3d14.305305207521522!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397d56a41deb36b%3A0x895fe62d4ea07b41!2sCountry%20Meadow%20Subdivision!5e1!3m2!1sen!2sph!4v1745062107194!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
        allowfullscreen=""
        loading="lazy"
    ></iframe>
</div>
@endsection
