<?php

namespace App\Providers;
use Livewire\Livewire;
use App\Http\Livewire\ProductCart;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Livewire::component('product-cart', ProductCart::class);

        View::composer('*', function ($view) {
            $count = 0;
    
            if (Auth::check()) {
                $cart = Cart::where('user_id', Auth::id())->with('items')->first();
                $count = $cart ? $cart->items->sum('quantity') : 0;
            }
    
            $view->with('cartItemCount', $count);
        });
    }
}
