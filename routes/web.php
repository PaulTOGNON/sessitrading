<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    $user = Auth::user();
    $orders = $user->orders()->with('items')->get();
    $favorites = $user->favorites()->get();
    $cartItems = $user->cartItems()->get();
    return view('dashboard', compact('orders', 'favorites', 'cartItems'));
})->middleware(['auth', 'verified'])->name('dashboard');

// Dynamic E-Commerce Routes
use App\Http\Controllers\CartController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\OrderController;

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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
