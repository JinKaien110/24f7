@extends('layouts.user.layout')

@section('title', 'Products')

@section('content')
<div class="min-h-screen bg-[#f9fafb] pt-[100px] px-6 md:px-16 pb-20">
    @include('layouts.user.alert')
    @include('users.partials.orders.order_title')

    <div class="flex flex-col-reverse lg:flex-row gap-10">
        @include('users.partials.orders.order_filter')
        <div class="w-full lg:w-[calc(100%-520px)]">
            @include('users.partials.orders.order_products')
        </div>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </div>

</div>
@endsection
