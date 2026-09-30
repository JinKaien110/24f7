@extends('layouts.admin.navigation')

@section('title', 'Products') 

@section('content')
<div class="container-fluid mt-4">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">
            @include('admin.partials.products.product_title')
            @include('admin.partials.products.product_create-product-modal')
            {{-- @include('admin.partials.products.product_add-product-modal') --}}
            @include('admin.partials.products.product_create-product-button')
            {{-- @include('admin.partials.products.product_add-product-button') --}}
            @include('admin.partials.alert')
            @include('admin.partials.products.product_table', ['products' => $products])
        </div>
    </div>
</div>

@endsection
