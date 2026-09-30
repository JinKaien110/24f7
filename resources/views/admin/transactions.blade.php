@extends('layouts.admin.navigation')

@section('title', 'Transactions')

@section('content')
<div class="container-fluid mt-4">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">
            @include('admin.partials.transactions.transaction_title')
            @include('admin.partials.transactions.transaction_filter-button')
            @include('admin.partials.alert')
            @include('admin.partials.transactions.transaction_table')
            @include('admin.partials.transactions.transaction_filter')
        </div>
    </div>
</div>
@endsection
