<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  // Make sure to import the Auth facade

class CartController extends Controller
{
    // Display the user's cart
    public function index()
    {
        // Get the cart for the logged-in user, or create a new one if not found
        $user = Auth::user();
        $cart = Cart::firstOrCreate(
            ['user_id' => Auth::id()], // Use Auth::id() here
            ['user_id' => Auth::id()]   // Ensuring the cart is created for the logged-in user
        );

        $cartItems = $cart->items()->with('product')->get();


        // If there are no items in the cart, set subtotal and total to 0
        if ($cartItems->isEmpty()) {
            $subtotal = 0;
            $vat = 0;
            $total = 0;
        } else {
            // Calculate subtotal, VAT, and total
            $subtotal = $cartItems->sum(function ($item) {
                return $item->quantity * $item->product->price;
            });
            $vat = $subtotal * 0.12; // 12% VAT
            $total = $subtotal + $vat;
        }

        // Return the cart view with cart items, subtotal, VAT, and total
        return view('users.carts.index', compact('cartItems', 'subtotal', 'vat', 'total', 'user'));
    }

    // Add item to the cart
    public function add($productId)
    {
        // Find the product by ID

        if (!Auth::check()) {
            return redirect()->route('login')->with('danger', 'You have to login first!');
        }

        $product = Product::findOrFail($productId);
    
        // Get the user's cart
        $cart = Auth::user()->cart;
    
        // Check if the product is already in the cart
        $existingCartItem = $cart->items()->where('product_id', $product->id)->first();
    
        if ($existingCartItem) {
            // If item exists, increase the quantity
            $existingCartItem->increment('quantity');
        } else {
            // If item doesn't exist, create a new cart item
            $cartItem = new CartItem();
            $cartItem->cart_id = $cart->id;  // Associate the item with the cart
            $cartItem->product_id = $product->id;
            $cartItem->quantity = 1; // Default quantity is 1
            $cartItem->save();
        }
    
        return response()->json([
            'success' => true,
            'message' => 'Item added to cart'
        ]);
        
    }
    

    // Update cart item quantity (increase/decrease)
    public function updateQuantity(Request $request, $id)
    {
        try {
            // Fetch the cart item with the associated product details
            $cartItem = CartItem::with('product', 'cart')->findOrFail($id);
    
            // Get the cart associated with the cart item
            $cart = $cartItem->cart;
    
            // Ensure the user is authenticated
            $userId = Auth::id();
            if (!$userId) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not authenticated. Please log in.'
                ]);
            }
    
            // Ensure the cart belongs to the logged-in user
            if ($cart->user_id !== $userId) {
                return response()->json([
                    'success' => false,
                    'message' => 'This cart item does not belong to the logged-in user.'
                ]);
            }
    
            // Get the action to either increase or decrease the quantity
            $action = $request->input('action');
    
            // Validate the action (increase or decrease)
            if ($action === 'increase') {
                $cartItem->quantity += 1;
            } elseif ($action === 'decrease') {
                $cartItem->quantity -= 1;
            
                if ($cartItem->quantity <= 0) {
                    $cartItem->delete();
            
                    // Recalculate cart totals
                    $userId = Auth::id();
                    $cartItems = CartItem::with('product')
                        ->whereHas('cart', function ($query) use ($userId) {
                            $query->where('user_id', $userId);
                        })
                        ->get();
            
                    $subtotal = $cartItems->sum(fn($item) => $item->quantity * $item->product->price);
                    $vat = $subtotal * 0.12;
                    $total = $subtotal + $vat;
            
                    return response()->json([
                        'success' => true,
                        'deleted' => true,
                        'subtotal' => number_format($subtotal, 2),
                        'vat' => number_format($vat, 2),
                        'total' => number_format($total, 2),
                    ]);

                    return redirect()->route('users.cart.index');
                }
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid quantity or action.'
                ]);
            }
            
            
            // Save the updated cart item
            $cartItem->save();
    
            // Recalculate subtotal, VAT, and total for all cart items of the user
            $cartItems = CartItem::with('product')
                ->where('cart_id', $cart->id)
                ->get();
    
            $subtotal = $cartItems->sum(function ($item) {
                return $item->quantity * $item->product->price;
            });
    
            // Calculate VAT (12% of subtotal)
            $vat = $subtotal * 0.12;
    
            // Calculate the total amount including VAT
            $total = $subtotal + $vat;
    
            // Return the updated cart data as JSON response
            return response()->json([
                'success' => true,
                'newQuantity' => $cartItem->quantity ?? 0,
                'deleted' => !isset($cartItem->id), // item was deleted
                'newTotalAmount' => number_format(($cartItem->quantity ?? 0) * $cartItem->product->price, 2),
                'subtotal' => number_format($subtotal, 2),
                'vat' => number_format($vat, 2),
                'total' => number_format($total, 2),
            ]);
            
        } catch (\Exception $e) {
    
            // Handle error
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating the cart. Please try again.',
                'error' => $e->getMessage(),  // Include the error message for debugging
            ]);
        }
    }
    
    
    


    // Remove an item from the cart
    public function remove($cartItemId)
    {
        // Find the cart item and delete it
        $cartItem = CartItem::findOrFail($cartItemId);
        $cartItem->delete();

        return redirect()->route('users.cart.index');
    }

    public function getCartItemCount()
    {
        $cart = Cart::where('user_id', Auth::id())->with('items')->first();
        $itemCount = $cart ? $cart->items->sum('quantity') : 0;

        return response()->json([
            'count' => $itemCount
        ]);
    }
    
}