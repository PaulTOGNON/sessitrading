<?php

namespace App\Services;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartService
{
    /**
     * Get all cart items for the current user (session or database).
     */
    public static function getCart(): array
    {
        if (Auth::check()) {
            return Auth::user()->cartItems()->get()
                ->filter(function ($item) {
                    return !is_null($item->product);
                })
                ->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'product_id' => $item->product_id,
                        'quantity' => $item->quantity,
                        'product' => $item->product,
                    ];
                })
                ->values()
                ->toArray();
        }

        $sessionCart = session()->get('cart', []);
        $cart = [];
        foreach ($sessionCart as $productId => $quantity) {
            $product = Product::allStatic()->firstWhere('id', $productId);
            if ($product) {
                $cart[] = [
                    'id' => $productId, // For guest, use product_id as item id
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'product' => $product,
                ];
            }
        }
        return $cart;
    }

    /**
     * Add a product to the cart.
     */
    public static function add(int $productId, int $quantity = 1): array
    {
        if (Auth::check()) {
            $item = Auth::user()->cartItems()->where('product_id', $productId)->first();
            if ($item) {
                $item->quantity += $quantity;
                $item->save();
            } else {
                Auth::user()->cartItems()->create([
                    'product_id' => $productId,
                    'quantity' => $quantity,
                ]);
            }
        } else {
            $cart = session()->get('cart', []);
            $cart[$productId] = ($cart[$productId] ?? 0) + $quantity;
            session()->put('cart', $cart);
        }

        return self::getCart();
    }

    /**
     * Update cart item quantity.
     */
    public static function update(int $itemId, int $change): array
    {
        if (Auth::check()) {
            $item = Auth::user()->cartItems()->find($itemId);
            if ($item) {
                $item->quantity += $change;
                if ($item->quantity <= 0) {
                    $item->delete();
                } else {
                    $item->save();
                }
            }
        } else {
            // For guests, itemId is the productId
            $cart = session()->get('cart', []);
            if (isset($cart[$itemId])) {
                $cart[$itemId] += $change;
                if ($cart[$itemId] <= 0) {
                    unset($cart[$itemId]);
                }
                session()->put('cart', $cart);
            }
        }

        return self::getCart();
    }

    /**
     * Remove item from cart.
     */
    public static function remove(int $itemId): array
    {
        if (Auth::check()) {
            $item = Auth::user()->cartItems()->find($itemId);
            if ($item) {
                $item->delete();
            }
        } else {
            // For guests, itemId is the productId
            $cart = session()->get('cart', []);
            unset($cart[$itemId]);
            session()->put('cart', $cart);
        }

        return self::getCart();
    }

    /**
     * Clear the cart.
     */
    public static function clear(): void
    {
        if (Auth::check()) {
            Auth::user()->cartItems()->delete();
        } else {
            session()->forget('cart');
        }
    }

    /**
     * Get the count of items in the cart.
     */
    public static function getCartCount(): int
    {
        $cart = self::getCart();
        return array_reduce($cart, function ($sum, $item) {
            return $sum + $item['quantity'];
        }, 0);
    }

    /**
     * Merge guest cart into user cart.
     */
    public static function mergeGuestCart($user): void
    {
        $sessionCart = session()->get('cart', []);
        foreach ($sessionCart as $productId => $quantity) {
            $item = $user->cartItems()->where('product_id', $productId)->first();
            if ($item) {
                $item->quantity += $quantity;
                $item->save();
            } else {
                $user->cartItems()->create([
                    'product_id' => $productId,
                    'quantity' => $quantity,
                ]);
            }
        }
        session()->forget('cart');
    }
}
