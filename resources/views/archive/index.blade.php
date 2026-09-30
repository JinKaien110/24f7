@extends('layouts.app') 

@section('content')
<div class="d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-lg p-4" style="width: 400px;">
            <h2 class="text-center">Reactivate Your Account</h2>
            <p class="text-center">Your account is currently deactivated. Click the button below to restore your account.</p>

            <form method="POST" action="{{ route('archive.reactive', $user->id) }}">
                @csrf
                <button type="submit" class="btn btn-primary w-100 mt-3">Reactivate My Account</button>
            </form>

            <div class="text-center mt-3">
                <a href="{{ route('login') }}">Back to Login</a>
            </div>
        </div>
    </div>
@endsection




