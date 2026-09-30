@extends('layouts.user.layout')

@section('title', 'Cart')

@section('content')
<div class="container mx-auto px-4 py-8 pt-[130px]">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Cart Items -->
        <div class="w-full lg:w-2/3">
            <h2 class="text-2xl font-semibold mb-6">Your Cart</h2>

            @if($cartItems->isEmpty())
                <div class="bg-blue-100 text-blue-800 px-4 py-3 rounded-md">
                    Your cart is empty. Add some products to continue shopping!
                </div>
            @else
                <div class="bg-white shadow-md rounded-lg p-6">
                    @foreach ($cartItems as $item)
                        <div class="flex justify-between items-center border-b border-gray-200 py-4" id="cart-item-{{ $item->id }}">
                            <div class="flex items-center space-x-4">
                                <img src="{{ asset('storage/' . $item->product->image) }}"
                                     alt="{{ $item->product->name }}"
                                     class="w-20 h-20 object-cover rounded-md">
                                <div>
                                    <h5 class="text-lg font-medium">{{ $item->product->name }}</h5>
                                    <p class="text-gray-500 text-sm">Price: ₱{{ number_format($item->product->price, 2) }}</p>
                                </div>
                            </div>

                            <div class="flex items-center space-x-3">
                                <button id="decrease-{{ $item->id }}" onclick="updateQuantity({{ $item->id }}, 'decrease')"
                                        class="px-2 py-1 text-lg font-bold border rounded hover:bg-gray-100">−</button>
                            
                                <span id="quantity-{{ $item->id }}" class="text-lg">{{ $item->quantity }}</span>
                            
                                <button id="increase-{{ $item->id }}" onclick="updateQuantity({{ $item->id }}, 'increase')"
                                        class="px-2 py-1 text-lg font-bold border rounded hover:bg-gray-100">+</button>
                            </div>
                            
                            <span id="total-amount-{{ $item->id }}" data-price="{{ $item->product->price }}">
                                ₱{{ number_format($item->quantity * $item->product->price, 2) }}
                            </span>
                            
                            

                            <div>
                                <form action="{{ route('users.cart.remove', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-500 text-white text-sm px-3 py-1 rounded hover:bg-red-600">
                                        Remove
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Address -->
<!-- Right Column: Address + Cart Summary -->
<div class="w-full lg:w-1/3 space-y-6">
    <!-- Address -->
    <div class="bg-white shadow-md rounded-lg p-6">
        <header>
            <h4 class="text-xl font-semibold mb-4">Address Contact Delivery</h4>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __("Update your account's profile contact and address.") }}
            </p>
        </header>
        
        <form method="post" action="{{ route('profile.update-contact') }}" class="mt-6 space-y-6">
            @csrf
            @method('patch')

            <div>
                <x-input-label for="address" :value="__('Address')" class="mt-2" />
                <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address', $user->address)" required autocomplete="street-address" />
                <x-input-error class="mt-2" :messages="$errors->get('address')" />
            </div>

            <!-- Phone Input -->
            <div>
                <x-input-label for="phone" :value="__('Phone Number')" />
                <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $user->phone)" required autocomplete="tel" />
                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
            </div>

            <!-- Save Button -->
            <div class="flex items-center gap-4 mt-6">
                <x-primary-button>{{ __('Save') }}</x-primary-button>

                @if (session('status') === 'contact-info-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600 dark:text-gray-400"
                    >{{ __('Saved.') }}</p>
                @endif
            </div>
        </form>
    </div>

    <!-- Cart Summary -->
    <div class="bg-white shadow-md rounded-lg p-6">
        <h4 class="text-xl font-semibold mb-4">Cart Summary</h4>
        <div class="mb-4 space-y-2">
            <p class="text-gray-700"><strong>Subtotal:</strong> ₱<span id="cart-subtotal">{{ number_format($subtotal, 2) }}</span></p>
            <p class="text-gray-700"><strong>VAT (12%):</strong> ₱<span id="cart-vat">{{ number_format($vat, 2) }}</span></p>
            <p class="text-gray-900 font-bold text-lg"><strong>Total:</strong> ₱<span id="cart-total">{{ number_format($total, 2) }}</span></p>
        </div>
        <div class="mt-6 border-t pt-4 text-right">
            {{-- Include the modal --}}
            @include('users.partials.carts.cart_checkout-modal')

            {{-- Checkout Button --}}
            <button 
                onclick="openModal()" 
                class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition 
                       {{ $cartItems->isEmpty() ? 'opacity-50 cursor-not-allowed' : '' }}"
                {{ $cartItems->isEmpty() ? 'disabled' : '' }}>
                Proceed to Checkout
            </button>
        </div>
    </div>
</div>

    </div>
</div>

@endsection
