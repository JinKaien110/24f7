@extends('layouts.admin.navigation')

@section('title', 'Order Management')

@section('content')
<div class="container-fluid mt-4">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">
            @include('admin.partials.orders.order_title')
            @include('admin.partials.orders.order_add-order')
            @include('admin.partials.orders.order_filter-order')
            @include('admin.partials.orders.order_buttons')
            @include('admin.partials.alert')
            @include('admin.partials.orders.order_all-orders-table')
            @vite('resources/js/admin-orders.js')
        </div>
    </div>
</div>
@endsection
