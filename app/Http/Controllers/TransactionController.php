<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
Use Carbon\Carbon;

use Illuminate\Http\Request;


class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::with(['orders.product', 'user'])->latest();
        
        if ($request->filled('payment_method')) {
            $query->where('payment_method', $request->payment_method);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
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

        $transactions = $query->paginate(10);
        
        $totalSales = $transactions->reduce(function ($carry, $transaction) {
            return $carry + ($transaction->amount_paid - $transaction->change);
         }, 0); 

         $users = User::orderBy('first_name')->get();
         $statuses = ['pending', 'cancelled', 'complete'];
         $methods = ['cash' ,'paymaya', 'gcash'];

        return view('admin.transactions', compact('transactions', 'totalSales', 'users', 'statuses', 'methods'));
    }
}