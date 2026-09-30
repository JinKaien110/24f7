<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class SimpleComponent extends Component
{
    public $products;
    public $cart = [];
    public $cartItems = [];

    public function mount()
    {
        $this->products = Product::all(); // Get all products
        $this->cart = session()->get('cart', []); // Get cart from session
        $this->cartItems = $this->cart;
    }

    public function addToCart($productId)
{
    $quantity = $this->quantity[$productId] ?? 1; // Default to 1 if no input

    $product = Product::find($productId);
    if (!$product) return;

    if (isset($this->cart[$productId])) {
        $this->cart[$productId]['quantity'] += $quantity;
    } else {
        $this->cart[$productId] = [
            'product_id' => $product->id,
            'name' => $product->name,
            'image' => $product->image,
            'price' => $product->price,
            'quantity' => $quantity,
            'total_amount' => $product->price * $quantity,
        ];
    }

    session()->put('cart', $this->cart);
    $this->dispatch('cartUpdated'); // Livewire v3
 // Ensure this event is handled in your component
    
}

    public function removeFromCart($productId)
    {
        $cart = $this->cart;

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
        }

        $this->cart = $cart;
        session()->put('cart', $cart);

        // Correct emit syntax
        $this->dispatch('cartUpdated'); // Livewire v3
    }

    public function openCheckoutModal()
{
    $this->dispatch('showCheckoutModal');
}

    public function render()
    {
        return view('livewire.simple-component');
    }
}
