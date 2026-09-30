<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductSerial;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Stock;
use App\Models\Order;
use App\Models\OrderSerial;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Str;

class OrderManagementController extends Controller
{
    public function orders(Request $request)
    {
        $users = User::withTrashed()->orderBy('first_name')->get();
        $usersForDropdown = User::whereNull('deleted_at')->orderBy('first_name')->get(); // used for "Add Order" modal
        $query = Order::with(['product', 'user', 'transaction'])->latest();
        $products = Product::withTrashed()->orderBy('name')->get();
        // Add both order statuses and refund-related options for filter display
        $statuses = ['pending', 'shipped', 'delivered', 'complete', 'cancelled', 'refunded'];
        $refundStatuses = ['requested', 'rejected',];

        $statusFilter = $request->status;

        if ($statusFilter) {
            if (Str::startsWith($statusFilter, 'status:')) {
                $actualStatus = Str::after($statusFilter, 'status:');
                $query->where('status', $actualStatus);
            } elseif (Str::startsWith($statusFilter, 'refund_status:')) {
                $actualRefundStatus = Str::after($statusFilter, 'refund_status:');
                $query->where('refund_status', $actualRefundStatus);
            }
        }

        if ($request->filled('refund_status')) {
            $query->where('refund_status', $request->refund_status);
        }

    
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [
                Carbon::parse($request->start_date)->startOfDay(),
                Carbon::parse($request->end_date)->endOfDay(),
            ]);
        }

        $orders = $query->paginate(10);
        $totalSubSales = $query->get()->sum('subtotal');

         

        return view('admin.orders', compact('orders', 'users', 'products', 'statuses', 'totalSubSales', 'usersForDropdown'));
    }

    public function manageOrders(Request $request)
    {
        $users = User::withTrashed()->orderBy('first_name')->get();
        $usersForDropdown = User::whereNull('deleted_at')->orderBy('first_name')->get(); // used for "Add Order" modal
        $query = Order::with(['product', 'user', 'transaction'])->latest();
        $products = Product::withTrashed()->orderBy('name')->get();
                // Add both order statuses and refund-related options for filter display
                $statuses = ['pending', 'shipped', 'delivered', 'complete', 'cancelled', 'refunded'];
                $refundStatuses = ['requested', 'rejected',];
        
                $statusFilter = $request->status;
        
                if ($statusFilter) {
                    if (Str::startsWith($statusFilter, 'status:')) {
                        $actualStatus = Str::after($statusFilter, 'status:');
                        $query->where('status', $actualStatus);
                    } elseif (Str::startsWith($statusFilter, 'refund_status:')) {
                        $actualRefundStatus = Str::after($statusFilter, 'refund_status:');
                        $query->where('refund_status', $actualRefundStatus);
                    }
                }
        
                if ($request->filled('refund_status')) {
                    $query->where('refund_status', $request->refund_status);
                }
        
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [
                Carbon::parse($request->start_date)->startOfDay(),
                Carbon::parse($request->end_date)->endOfDay(),
            ]);
        }

        $orders = $query->paginate(10);
        $totalSubSales = $query->get()->sum('subtotal');

         

        return view('admin.partials.orders.order_management-orders-table', compact('orders', 'users', 'products', 'statuses', 'totalSubSales', 'usersForDropdown'));
    }

    public function approveOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'shipped';
        $order->save();

        // Update the transaction status as well
        $transaction = Transaction::findOrFail($order->transaction_id);
        $transaction->status = 'shipped';  // Assuming you have a 'status' field in the transaction table
        $transaction->save();

        return redirect()->back()->with('success', 'Order approved successfully!');
    }

    public function cancelOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'cancelled';
        $order->save();

        // If the order is cancelled, you may want to cancel the associated transaction as well
        $transaction = Transaction::findOrFail($order->transaction_id);
        $transaction->status = 'cancelled';  // Assuming you have a 'status' field in the transaction table
        $transaction->save();

        return redirect()->back()->with('success', 'Order cancelled successfully.');
    }

    public function pendingOrder($id) {
        $order = Order::findOrFail($id);
        $order->status = 'pending';
        $order->save();

        $transaction = Transaction::findOrFail($order->transaction_id);
        $transaction->status = 'pending';
        $transaction->save();

        return redirect()->back()->with('success', 'Order pending successfully!');
    }

    public function addOrder(Request $request) {

    $validator = Validator::make($request->all(), [
        'user_id' => 'required|exists:users,id',
        'product_id' => 'required|array|min:1',
        'product_id.*' => 'exists:products,id',
        'quantity' => 'required|array|min:1',
        'quantity.*' => 'integer|min:1',
        'payment_method' => 'required|in:cash,paymaya,gcash',
        'amount_paid' => 'required|numeric|min:0',
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    $user_id = $request->user_id;
    $product_ids = $request->product_id;
    $quantities = $request->quantity;

    $subtotal = 0;
    $orders = [];
    $productSerials = [];

    // Step 1: Loop through and calculate subtotal
    foreach ($product_ids as $index => $product_id) {
        $product = Product::withTrashed()->find($product_id);
    
        if (!$product) {
            // Log error or notify user that the product is invalid or deleted
            continue;  // Skip this product and move to the next
        }
        
        $quantity = $quantities[$index];
        $price = $product->price;
        $lineSubtotal = $price * $quantity;

        $subtotal += $lineSubtotal;

            // 🟡 Find the first available serial number
            $serials = ProductSerial::where('product_id', $product_id)
                ->where('status', 'available')
                ->orderBy('id', 'asc')
                ->limit($quantity)
                ->get();

            if ($serials->count() < $quantity) {
                return back()->with('error', "Not enough serial numbers available for product ID $product_id.");
            }

            $productSerials[$product_id] = $serials;

    }

    // Step 2: Now compute VAT, total, change
    $vat = $subtotal * 0.12;
    $total = $subtotal + $vat;
    $change = $request->amount_paid - $total;

    // Step 3: Create the transaction
    $transaction = Transaction::create([
        'user_id' => $user_id,
        'payment_method' => $request->payment_method,
        'amount_paid' => $request->amount_paid,
        'total_amount' => $total,
        'change' => $change,
        'vat_amount' => $vat,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

        
    foreach ($product_ids as $index => $product_id) {
        $product = Product::withTrashed()->find($product_id);
        $quantity = $quantities[$index];
        $price = $product->price;
        $serials = $productSerials[$product_id] ?? collect();
    
        foreach ($serials as $serial) {
            $order = Order::create([
                'user_id'        => $user_id,
                'product_id'     => $product_id,
                'transaction_id' => $transaction->id,
                'quantity'       => 1,
                'price'          => $price,
                'subtotal'       => $price,
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
    
            $orders[] = $order;
        }
    
        // ✅ Reduce stock once per product
        $product->stock->decrement('quantity', $quantity);
    }
    

    

    return redirect()->route('admin.orders.index')->with('success', 'Order(s) created successfully!');
}

public function approveRefund($orderId)
{
    $order = Order::with('serials.productSerial')->findOrFail($orderId);


    if ($order->refund_status !== 'requested') {
        return back()->with('error', 'Refund not requested for this order.');
    }

    // Update refund status
    $order->update([
        'refund_status' => 'approved',
        'status' => 'refunded'
    ]);

    if (strtolower($order->action_reason) === 'item defect or issue') {
        foreach ($order->serials as $orderSerial) {
            $productSerial = $orderSerial->productSerial;
            if ($productSerial) {
                \Log::info('Updating serial BEFORE', [
                    'serial_id' => $productSerial->id,
                    'status_before' => $productSerial->status
                ]);
    
                $productSerial->update(['status' => 'damaged']);
    
                // Refresh to confirm
                $productSerial->refresh();
    
                \Log::info('Updating serial AFTER', [
                    'serial_id' => $productSerial->id,
                    'status_after' => $productSerial->status
                ]);
            }
        }
    }
    
    
    


    if ($order->product && $order->product->stock) {
        $order->product->stock->increment('quantity', $order->quantity);
    }
    
    return back()->with('success', 'Refund approved and product updated.');
}


public function rejectRefund(Order $order)
{
    if ($order->refund_status !== 'requested') {
        return back()->with('error', 'Refund cannot be rejected.');
    }

    $order->update([
        'refund_status' => 'rejected',
        'status', 'complete',
    ]);

    return back()->with('success', 'Refund request rejected.');
}

public function markAsShipped(Order $order)
{
    if ($order->status !== 'pending') {
        return back()->with('error', 'Only pending orders can be marked as shipped.');
    }

    $order->update([
        'status' => 'shipped',
    ]);

    return back()->with('success', 'Order marked as shipped.');
}

public function markAsDelivered(Order $order)
{
    if ($order->status !== 'shipped') {
        return back()->with('error', 'Only shipped orders can be marked as delivered.');
    }

    $order->update([
        'status' => 'delivered',
    ]);

    return back()->with('success', 'Order marked as delivered.');
}



}
