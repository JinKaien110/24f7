<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
Use App\Http\Controllers\ReactivationController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserOrderController;
use App\Http\Controllers\UserViewController;
use App\Http\Controllers\SystemUserController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\OrderManagementController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserOrderHistoryController;


use App\Http\Middleware\AdminMiddleware;
use App\http\Middleware\SoftDeletedMiddleware;
use App\Http\Middleware\UserMiddleware;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::prefix('users')->name('users.')->group(function () {

    // User Orders Route
    Route::get('/orders', [UserOrderController::class, 'index'])->name('orders.index');

    // Partials
    Route::get('/store-locator', [UserViewController::class, 'view'])->name('store.locator');
    



       




});
Route::get('/users/cart/item-count', [CartController::class, 'getCartItemCount'])->name('users.cart.count');




Route::resource('products', ProductController::class);


// Route::get('/search', [UserOrderController::class, 'search'])->name('search');

Route::middleware('auth')->group(function () {
    // User Middleware
    Route::middleware([UserMiddleware::class])->group(function () {
        Route::get('/welcome', function () {
            return view('welcome');
        })->name('UserDashboard');

        Route::prefix('users')->name('users.')->group(function () {

            Route::get('/profile/my-orders', [UserOrderHistoryController::class, 'index'])->name('profile.order.history');
            Route::get('/profile/my-orders/{id}', [UserOrderHistoryController::class, 'show'])->name('orders.show');
                Route::patch('/profile/my-orders/{id}/cancel', [UserOrderHistoryController::class, 'cancelOrder'])->name('users.profile-order.cancel');
                Route::patch('/profile/my-orders/{id}/refund', [UserOrderHistoryController::class, 'requestRefund'])->name('users.profile-order.refund-request');
                Route::patch('/profile/my-orders/{id}/cancel-refund', [UserOrderHistoryController::class, 'cancelRefund'])->name('profile-order.cancelrefund');
                Route::patch('/profile/my-orders/{id}/confirm-order', [UserOrderHistoryController::class, 'confirmOrder'])->name('profile-order.confirmOrder');

            Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
            Route::post('/cart/{productId}/add', [CartController::class, 'add'])->name('cart.add');
             Route::post('/cart/update-quantity/{itemId}', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
            Route::delete('/cart/{cartItemId}/remove', [CartController::class, 'remove'])->name('cart.remove');
            
            Route::post('/orders/add', [UserOrderController::class, 'store'])->name('orders.store');
            Route::get('/orders/add/{productId}', [UserOrderController::class, 'addToCart'])->name('orders.addToCart');
            Route::get('/orders/remove/{productId}', [UserOrderController::class, 'removeFromCart'])->name('orders.removeFromCart');
            Route::post('/orders/checkout', [UserOrderController::class, 'checkout'])->name('orders.checkout');
            Route::post('/orders/finalize', [UserOrderController::class, 'finalize'])->name('orders.finalize');

            Route::get('/orders/checkout-success', [UserOrderController::class, 'showSuccessPage'])->name('orders.checkout-success');

            });

    // Profile Update
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/update-contact', [ProfileController::class, 'updateContactInformation'])->name('profile.update-contact');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    });    


    Route::middleware([AdminMiddleware::class])->group(function () {
        Route::prefix('admin')->name('admin.')->group(function () {

        Route::get('/', [AdminDashboardController::class, 'index'])->name('index');

        Route::get('system_users', function () {
            return view('admin.system_users');
        })->name('system_users');

        Route::get('products', [ProductController::class, 'index'])->name('admin.products');
        })->name('products');

        // User CRUD
        Route::resource('system_users', SystemUserController::class)->names('system_users');
        Route::delete('system_users/delete/{user}', [SystemUserController::class, 'destroy'])->name('system_user.delete');
        Route::patch('/users/{user}/toggle-status', [SystemUserController::class, 'toggleStatus'])->name('users.toggleStatus');
        Route::post('/users/{id}/restore', [SystemUserController::class, 'restore'])->name('users.restore');

        
        // Product CRUD
        Route::get('products', [ProductController::class, 'index'])->name('products');
        Route::post('products', [ProductController::class, 'store'])->name('products.create');
        Route::put('products/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
        Route::get('/product/{productId}/serials', [ProductController::class, 'showProductSerials'])->name('product.serials');



        // Display all stocks
    Route::get('inventory', [StockController::class, 'index'])->name('inventory');

    // Show the form to create a new stock
    Route::get('inventory/create', [StockController::class, 'create'])->name('createStock');

    // Store the new stock
    Route::post('inventory', [StockController::class, 'store'])->name('addStock');

    // Show the form to edit stock
    Route::get('inventory/{id}/edit', [StockController::class, 'edit'])->name('editStock');

    // Update the stock
    Route::put('inventory/{id}', [StockController::class, 'update'])->name('updateStock');

    // Delete the stock
    Route::delete('inventory/{id}', [StockController::class, 'destroy'])->name('deleteStock');

    Route::post('inventory', [StockController::class, 'add'])->name('inventory.add');

    // Orders Management
    Route::get('/orders', [OrderManagementController::class, 'orders'])->name('admin.orders.index');
    Route::get('/orders/management', [OrderManagementController::class, 'manageOrders'])->name('admin.orders.management');
    Route::get('/orders/create', [OrderManagementController::class, 'create'])->name('orders.create');
    Route::post('/orders/store', [OrderManagementController::class, 'addOrder'])->name('admin.orders.store');
    Route::patch('/orders/{id}/approve', [OrderManagementController::class, 'approveOrder'])->name('orders.approve');
    Route::patch('/orders/{id}/cancel', [OrderManagementController::class, 'cancelOrder'])->name('orders.cancel');
    Route::patch('/orders/{id}/pending', [OrderManagementController::class, 'pendingOrder'])->name('orders.pending');
    Route::patch('/orders/{order}/approve-refund', [OrderManagementController::class, 'approveRefund'])->name('orders.approveRefund');
    Route::patch('/orders/{order}/reject-refund', [OrderManagementController::class, 'rejectRefund'])->name('orders.rejectRefund');
    Route::patch('/orders/{order}/ship', [OrderManagementController::class, 'markAsShipped'])->name('orders.ship');
    Route::patch('/orders/{order}/deliver', [OrderManagementController::class, 'markAsDelivered'])->name('orders.deliver');



    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');

    });
});

    


        


Route::middleware([SoftDeletedMiddleware::class])->group(function () {
    Route::get('archive/{user}', [ReactivationController::class, 'show'])->name('archive.show');
    Route::post('archive/{user}', [ReactivationController::class, 'reactivate'])->name('archive.reactive');
});

Route::resource('stocks', StockController::class);

Route::get('/about', function () {
    return view('users.about');
})->name('about');

Route::view('/terms', '/users/terms')->name('terms');

Route::view('/private', '/users/private')->name('private');

Route::view('/faq', '/users/faq')->name('faq');

Route::view('/developer', '/users/developer')->name('developer');




require __DIR__.'/auth.php';
