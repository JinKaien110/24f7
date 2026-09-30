@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h2>Order Placed Successfully!</h2>
    <p>Thank you for your order. Your order is now being processed.</p>
    <a href="{{ route('users.orders.index') }}" class="btn btn-primary">View My Orders</a>
</div>
@endsection
