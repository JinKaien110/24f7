<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;

class ProductCartComponent extends Component
{
    public $products;
    public $cart = [];

    public function mount()
    {
        $this->products = Product::all(); // Get all products
        $this->cart = session()->get('cart', []); // Get cart from session
    }

    public function addToCart($productId, $quantity)
    {
        $product = Product::find($productId);
        $cart = $this->cart;
        
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'name' => $product->name,
                'image' => $product->image,
                'price' => $product->price,
                'quantity' => $quantity,
                'total_amount' => $product->price * $quantity,
            ];
        }

        $this->cart = $cart;
        session()->put('cart', $cart);
        $this->emit('cartUpdated'); // Notify other components if needed
    }

    public function removeFromCart($productId)
    {
        $cart = $this->cart;

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
        }

        $this->cart = $cart;
        session()->put('cart', $cart);
        $this->emit('cartUpdated'); // Notify other components if needed
    }

    public function render()
    {
        return view('livewire.product-cart-component');
    }
}
