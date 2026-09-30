<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Stock;
use App\Models\Order;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        // Fetch chart data

        $users = User::orderBy('first_name')->get(); // or however your customers are stored

        $chartData = $this->chart($request);

        // Total products in the inventory
        $totalProducts = Product::count();

        // Products needing reorder (e.g., quantity less than reorder level)
        $productsNeedingReorder = Stock::whereColumn('quantity', '<=', 'reorder_level')->count();


        $totalSalesToday = DB::table('transactions')
        ->whereDate('transactions.created_at', today())
        ->sum('amount_paid'); // Sales = full payment amount

        $totalRevenueToday = DB::table('transactions')
        ->whereDate('created_at', today())
        ->selectRaw('SUM(amount_paid - `change`) as total')
        ->value('total');

        // Pending orders
        $pendingOrders = Order::where('status', 'pending')->count();

        $recentOrders = Order::with('user', 'product', 'transaction')
            ->orderBy('created_at', 'desc')  // First, get the most recent orders
            ->limit(5)  // Limit to the 5 most recent orders
            ->get();

        $totalUsers = User::count();

        // Then, sort them by 'id' in ascending order for display
        $recentOrders = $recentOrders->sortBy('id'); // Sort in ascending order by ID
        $totalRecentSubtotal = $recentOrders->sum('subtotal');

        // Return the view with data and chart data
        return view('admin.index', compact(
            'totalProducts',
            'productsNeedingReorder',
            'totalSalesToday',
            'totalRevenueToday',
            'totalUsers',
            'pendingOrders',
            'recentOrders',
            'chartData', // Pass the chart data here
            'users',
            'totalRecentSubtotal'
        ));
    }

    public function chart(Request $request) {
        // Default date range (Last 30 days by default)
        $startDate = $request->start_date ?? Carbon::now()->subDays(30)->toDateString();
        $endDate = $request->end_date ?? Carbon::now()->toDateString();
    
        // Handle predefined time ranges ONLY if no manual date range is set
        if (!$request->has('start_date') && !$request->has('end_date') && $request->has('time_range')) {
            switch ($request->time_range) {
                case 'last_7_days':
                    $startDate = Carbon::now()->subDays(7)->toDateString();
                    $endDate = Carbon::now()->toDateString();
                    break;
                case 'last_30_days':
                    $startDate = Carbon::now()->subDays(30)->toDateString();
                    $endDate = Carbon::now()->toDateString();
                    break;
                case 'this_month':
                    $startDate = Carbon::now()->startOfMonth()->toDateString();
                    $endDate = Carbon::now()->toDateString();
                    break;
                case 'last_month':
                    $startDate = Carbon::now()->subMonth()->startOfMonth()->toDateString();
                    $endDate = Carbon::now()->subMonth()->endOfMonth()->toDateString();
                    break;
                case 'ytd':
                    $startDate = Carbon::now()->startOfYear()->toDateString();
                    $endDate = Carbon::now()->toDateString();
                    break;
            }
        }
    
      // Build the query with filters
      $query = DB::table('orders')
        ->join('transactions', 'orders.transaction_id', '=', 'transactions.id')
        ->whereBetween('orders.created_at', [$startDate, $endDate]); // Date range filter

        $statusFilter = $request->status;

        if ($statusFilter) {
            if (Str::startsWith($statusFilter, 'status:')) {
                $actualStatus = Str::after($statusFilter, 'status:');
                $query->where('orders.status', $actualStatus);
            } elseif (Str::startsWith($statusFilter, 'refund_status:')) {
                $actualRefundStatus = Str::after($statusFilter, 'refund_status:');
                $query->where('orders.refund_status', $actualRefundStatus);
            }
        }
        if ($request->payment_method) {
            $query->where('transactions.payment_method', $request->payment_method);
        }

        if ($request->min_revenue) {
            $query->where(DB::raw('(transactions.amount_paid - `change`)'), '>=', $request->min_revenue);
        }

        if ($request->max_revenue) {
            $query->where(DB::raw('(transactions.amount_paid - `change`)'), '<=', $request->max_revenue);
        }

        if ($request->user_id) {
            $query->where('orders.user_id', $request->user_id);
        }

        // Execute the query
        $orders = $query->selectRaw('
            DATE(orders.created_at) as date,
            COUNT(DISTINCT orders.id) as order_count,
            SUM(transactions.amount_paid - `change`) as total_revenue
        ')
        ->groupByRaw('DATE(orders.created_at)')
        ->orderBy('date')
        ->get();

        return [
            'dates' => $orders->pluck('date'),
            'orderCounts' => $orders->pluck('order_count'),
            'revenues' => $orders->pluck('total_revenue'),
        ];

        

    }
}
