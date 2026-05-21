<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Add product to cart.
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        $cart = CartService::add($productId, $quantity);
        $count = CartService::getCartCount();

        return response()->json([
            'success' => true,
            'message' => 'Produit ajouté au panier !',
            'cart' => $cart,
            'count' => $count,
        ]);
    }

    /**
     * Update cart item quantity.
     */
    public function update(Request $request)
    {
        $request->validate([
            'item_id' => 'required|integer',
            'change' => 'required|integer',
        ]);

        $itemId = $request->input('item_id');
        $change = $request->input('change');

        $cart = CartService::update($itemId, $change);
        $count = CartService::getCartCount();

        return response()->json([
            'success' => true,
            'cart' => $cart,
            'count' => $count,
        ]);
    }

    /**
     * Remove item from cart.
     */
    public function remove(Request $request)
    {
        $request->validate([
            'item_id' => 'required|integer',
        ]);

        $itemId = $request->input('item_id');

        $cart = CartService::remove($itemId);
        $count = CartService::getCartCount();

        return response()->json([
            'success' => true,
            'message' => 'Produit retiré du panier.',
            'cart' => $cart,
            'count' => $count,
        ]);
    }
}
