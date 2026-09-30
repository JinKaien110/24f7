@extends('layouts.admin.navigation')

@section('title', 'Inventory')

@section('content')
<div class="container-fluid mt-4">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">
            @include('admin.partials.inventory.inventory_title')
            @include('admin.partials.inventory.inventory_add-stock-button')
            @include('admin.partials.inventory.inventory_add-stock-modal')
            @include('admin.partials.alert')
            @include('admin.partials.inventory.inventory_table', ['stocks' => $stocks])
        </div>
    </div>
</div>
@endsection
