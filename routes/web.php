<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PaymentSettingController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\Admin\NewsletterSubscriberController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ProductController::class, 'index'])->name('store.index');
Route::get('/products', [ProductController::class, 'shop'])->name('store.shop');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('store.show');

// Informational & Legal Pages
Route::view('/politique-de-retour', 'pages.retour')->name('store.retour');
Route::view('/mentions-legales', 'pages.mentions')->name('store.mentions');
Route::view('/cgv', 'pages.cgv')->name('store.cgv');
Route::view('/donnees-privees', 'pages.donnees')->name('store.donnees');

Route::get('/dashboard', function () {
    $user = Auth::user();
    if ($user && $user->is_admin) {
        return redirect()->route('admin.dashboard');
    }
    if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail()) {
        return redirect()->route('verification.notice');
    }
    $orders = $user->orders()->with('items')->get();
    $favorites = $user->favorites()->get();
    $cartItems = $user->cartItems()->get();
    return view('dashboard', compact('orders', 'favorites', 'cartItems'));
})->middleware(['auth'])->name('dashboard');

// Dynamic E-Commerce Routes
Route::get('/api/store-data', function () {
    return response()->json([
        'cart' => \App\Services\CartService::getCart(),
        'favorites' => \App\Services\WishlistService::getFavorites(),
    ]);
});

Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

Route::post('/favorites/toggle', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
Route::post('/orders/place', [OrderController::class, 'store'])->name('orders.store')->middleware('auth');

// Newsletter Route
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

// FedaPay Payment Routes
Route::get('/checkout/pay/{order}', [PaymentController::class, 'pay'])->name('checkout.pay')->middleware('auth');
Route::get('/checkout/callback/{order}', [PaymentController::class, 'callback'])->name('checkout.callback');
Route::post('/fedapay/webhook', [PaymentController::class, 'webhook'])->name('checkout.webhook');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Panel Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/analytics', [AdminController::class, 'analytics'])->name('analytics');
    
    // User management
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::post('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
    Route::post('/users/{user}/toggle', [AdminController::class, 'toggleUserStatus'])->name('users.toggle');
    Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');
    
    // Order management
    Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
    Route::post('/orders/{order}/status', [AdminController::class, 'updateOrderStatus'])->name('orders.status');
    
    // Product management
    Route::get('/products', [AdminController::class, 'products'])->name('products');
    Route::post('/products', [AdminController::class, 'storeProduct'])->name('products.store');
    Route::post('/products/{product}', [AdminController::class, 'updateProduct'])->name('products.update');
    Route::delete('/products/{product}', [AdminController::class, 'destroyProduct'])->name('products.destroy');

    // FedaPay Configuration & Transactions
    Route::get('/payment-settings', [PaymentSettingController::class, 'index'])->name('payment-settings.index');
    Route::post('/payment-settings', [PaymentSettingController::class, 'update'])->name('payment-settings.update');
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');

    // Newsletter Management
    Route::get('/newsletter', [NewsletterSubscriberController::class, 'index'])->name('newsletter.index');
    Route::delete('/newsletter/{subscriber}', [NewsletterSubscriberController::class, 'destroy'])->name('newsletter.destroy');
    Route::get('/newsletter/export', [NewsletterSubscriberController::class, 'export'])->name('newsletter.export');
});

require __DIR__.'/auth.php';
