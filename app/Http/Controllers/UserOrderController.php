<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductSerial;
use App\Models\Order;
use App\Models\OrderSerial;
use App\Models\Stock;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;
use App\Models\Cart;

class UserOrderController extends Controller
{
    // Step 1: Show products & cart on the same page
    public function index(Request $request)
    {
        $user = Auth::user();
        $products = Product::query();
            $query = $request->input('query');
                if ($query) {
        $products = $products->where('name', 'like', "%{$query}%")
                             ->orWhere('description', 'like', "%{$query}%")
                             ->orWhere('price', 'like', "%{$query}%")
                             ->orWhere('type', 'like', "%{$query}%")
                             ->orWhere('horsepower', 'like', "%{$query}%")
                             ->orWhere('brand', 'like', "%{$query}%");
    }

    
        // Filter by Brand
        if ($request->filled('brand')) {
            $products->where('brand', $request->brand);
        }
    
        // Filter by Type (Array: ['Window', 'Split'])
        // For radio values (single string, not array)
        if ($request->filled('type')) {
            $products->where('type', $request->type);
        }

        if ($request->filled('hp')) {
            $products->where('horsepower', $request->hp);
        }

        if ($request->filled('price_range')) {
            [$min, $max] = explode('-', $request->price_range);
            $products->whereBetween('price', [(float)$min, (float)$max]);
        }

        if ($request->filled('sort_by')) {
            switch ($request->sort_by) {
                case 'price_asc':
                    $products->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $products->orderBy('price', 'desc');
                    break;
                case 'name_asc':
                    $products->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $products->orderBy('name', 'desc');
                    break;
            }
        }
        
        
    
        // Paginate or get all
        $products = $products->get(); // Or ->paginate(10) if you want pagination
    
        $cart = Cart::where('user_id', Auth::id())->with('items.product')->first();
        $cartItems = $cart?->items ?? [];
        

        return view('users.orders.index', compact('products', 'cartItems', 'user', 'query'));
    }

  //  public function search(Request $request)
    // {
    //$query = $request->input('query');

    //$products = Product::where('name', 'like', "%{$query}%")
      //          ->orWhere('brand', 'like', "%{$query}%")
        //        ->orWhere('type', 'like', "%{$query}%")
          //      ->get();

  //  return view('users.search-result', compact('products', 'query'));
//}

    
    // Step 2: Add product to cart (or update quantity if it exists)
    public function store(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'nullable|integer|min:1',
    ]);

    $product = Product::findOrFail($request->product_id);
    $quantity = $request->input('quantity', 1); // Default quantity = 1
    $cart = session()->get('cart', []);

    if (isset($cart[$product->id])) {
        $cart[$product->id]['quantity'] += $quantity;
        $cart[$product->id]['total_amount'] = $cart[$product->id]['price'] * $cart[$product->id]['quantity'];
    } else {
        $cart[$product->id] = [
            'product_id'   => $product->id,
            'name'         => $product->name,
            'image'        => $product->image,
            'price'        => $product->price,
            'quantity'     => $quantity,
            'total_amount' => $product->price * $quantity,
        ];
    }

    session()->put('cart', $cart);

    return redirect()->route('users.orders.index')->with('success', 'Product added to cart!');
}

    

    // Step 4: Finalize Order (Choose Payment & Pay)
    public function finalize(Request $request)
    {
        // Step 1: Retrieve the user's cart items from the database
        $cart = Cart::where('user_id', Auth::id())->with('items.product.stock')->first();
        $cartItems = $cart?->items ?? collect();
    
        if ($cartItems->isEmpty()) {
            return redirect()->route('users.orders.index')->withErrors(['error' => 'Your cart is empty.']);
        }
    
        // Step 2: Calculate subtotal
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $product = $item->product;
    
            if (!$product) {
                return redirect()->back()->withErrors(['error' => 'One of the products no longer exists.']);
            }
    
            $subtotal += $product->price * $item->quantity;
        }
    
        // Step 3: Calculate VAT, total, change
        $vat = $subtotal * 0.12;
        $total = $subtotal + $vat;
    
        // Validate payment amount and method
        $request->validate([
            'amount_paid' => 'required|numeric|min:' . $total,
            'payment_method' => 'required|string',
        ]);
    
        $change = $request->amount_paid - $total;
    
        // Step 4: Begin database transaction
        DB::beginTransaction();
    
        try {
            // Create the transaction
            $transaction = Transaction::create([
                'user_id'       => Auth::id(),
                'payment_method'=> $request->payment_method,
                'amount_paid'   => $request->amount_paid,
                'total_amount'  => $total,
                'vat_amount'    => $vat,
                'change'        => $change,
                'status'        => 'pending',
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
    
            // Step 5: Create orders, update stock, and mark serials as sold
            foreach ($cartItems as $item) {
                $product = $item->product;
                $quantity = $item->quantity;
                $price = $product->price;
                $lineSubtotal = $price * $quantity;
            
                if (!$product->stock || $product->stock->quantity < $quantity) {
                    DB::rollBack();
                    return back()->withErrors(['error' => "Insufficient stock for {$product->name}."]);
                }
            
                $serials = ProductSerial::where('product_id', $product->id)
                    ->where('status', 'available')
                    ->orderBy('id')
                    ->limit($quantity)
                    ->get();
            
                if ($serials->count() < $quantity) {
                    DB::rollBack();
                    return back()->withErrors(['error' => "Not enough serials for {$product->name}."]);
                }
            
                // ✅ Create one order per product item
                foreach ($serials as $serial) {
                    $order = Order::create([
                        'user_id'        => Auth::id(),
                        'transaction_id' => $transaction->id,
                        'product_id'     => $product->id,
                        'quantity'       => 1, // single unit
                        'price'          => $price,
                        'subtotal'       => $price, // per unit
                        'order_status'   => 'pending',
                        'created_at'     => now(),
                        'updated_at'     => now(),
                    ]);
                
                    $serial->status = 'sold';
                    $serial->save();
                
                    OrderSerial::create([
                        'order_id' => $order->id,
                        'product_serial_id' => $serial->id,
                    ]);
                }
                
            
                // ✅ Decrement stock
                $product->stock->decrement('quantity', $quantity);

            }
            
    
            // Step 6: Clear cart items after the order is placed
            if ($cart) {
                CartItem::where('cart_id', $cart->id)->delete();
            }
    
            DB::commit();
    
            return redirect()->route('users.orders.checkout-success')
                 ->with('success', 'Order placed! Waiting for admin confirmation.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Order failed: ' . $e->getMessage()]);
        }
    }

    public function showSuccessPage()
{
    return view('users.partials.orders.checkout-success');
}
    
    public function addToCart(Request $request, $productId) {
        // Find the product
        $product = Product::findOrFail($productId);
        
        // Retrieve the cart from session or create an empty array if it doesn't exist
        $cart = session()->get('cart', []);
    
        // Check if the product is already in the cart
        if (isset($cart[$productId])) {
            // Increase quantity if product is already in the cart
            $cart[$productId]['quantity']++;
        } else {
            // Add new product to the cart
            $cart[$productId] = [
                'name' => $product->name,
                'image' => $product->image,
                'price' => $product->price,
                'quantity' => 1,
                'total_amount' => $product->price, // Initialize total amount based on price and quantity
            ];
        }
    
        // Store the updated cart in session
        session()->put('cart', $cart);
    
        return redirect()->route('users.orders.index');
    }
    

    // Remove item from cart
    public function removeFromCart($productId) {
        // Get the cart from session
        $cart = session()->get('cart', []);
    
        // Remove the item from the cart
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
        }
    
        // Store the updated cart in session
        session()->put('cart', $cart);
    
        return redirect()->route('users.orders.index');
    }
    
}
