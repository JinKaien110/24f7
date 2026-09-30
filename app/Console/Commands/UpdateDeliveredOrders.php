<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;

class UpdateDeliveredOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:delivered-orders';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Find all orders that are "shipped" and shipped 1 day ago
        $orders = \App\Models\Order::where('status', 'shipped')
            ->where('updated_at', '<=', now()->subDay())
            ->get();
    
        foreach ($orders as $order) {
            $order->update([
                'status' => 'delivered',
            ]);
    
            $this->info('Order ID ' . $order->id . ' marked as delivered.');
        }
    
        $this->info('Checked for shipped orders successfully.');
    }
    
}
