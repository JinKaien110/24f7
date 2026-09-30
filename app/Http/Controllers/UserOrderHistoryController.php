<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class UserOrderHistoryController extends Controller
{
    public function index() {
        $orders = Order::with(['transaction', 'product'])
        ->whereHas('transaction', function ($q) {
            $q->where('user_id', Auth::user()->id);
        })
        ->orderBy('created_at', 'desc')
        ->get();

    return view('users.profile.index', compact('orders'));
    }

    // Handle cancel order request
    public function cancelOrder(Request $request, $orderId) {
        $order = Order::findOrFail($orderId);
    
        if ($order->status !== 'pending') {
            return back()->with('error', 'Only pending orders can be canceled.');
        }
    
        $reason = $request->input('reason') === 'Other'
            ? $request->input('custom_reason')
            : $request->input('reason');
    
        $order->update([
            'status' => 'cancelled',
            'action_reason' => $reason,
        ]);
    
        return back()->with('success', 'Order successfully canceled.');
    }
    
    public function requestRefund(Request $request, $orderId) {
        $order = Order::findOrFail($orderId);
    
        if ($order->status !== 'shipped' && $order->status !== 'delivered') {
            return back()->with('error', 'Only completed orders can be refunded.');
        }
    
        $reason = $request->input('reason') === 'Other'
            ? $request->input('custom_reason')
            : $request->input('reason');
    
        $order->update([
            'refund_status' => 'requested',
            'action_reason' => $reason,
        ]);
    
        return back()->with('success', 'Refund requested.');
    }
    
    public function cancelRefund(Request $request, $orderId) {

        $order = Order::findOrFail($orderId);

        if ($order->refund_status !== 'requested') {
            return back()->with('danger', 'Only requested refund can be cancel.');
        }

            $order->update([
                'refund_status' => 'cancelled',
            ]);

        return back()->with('success', 'Refund request has been cancel.');    

        }

    public function confirmOrder(Request $request, $orderId) {

            $order = Order::findOrFail($orderId);
    

            if ($order->status !== 'shipped' && $order->status !== 'delivered') {
                return back()->with('danger', 'Only shipped or delivered orders can be confirmed.');
            }
    
                $order->update([
                    'status' => 'complete',
                ]);
    
            return back()->with('success', 'Delivery has been confirmed.');    
    
            }

    }
    
