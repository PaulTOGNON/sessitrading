<?php

namespace App\Http\Controllers;

use App\Services\WishlistService;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    /**
     * Toggle a product in user's favorites list.
     */
    public function toggle(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
        ]);

        $productId = $request->input('product_id');
        $res = WishlistService::toggle($productId);

        return response()->json([
            'success' => true,
            'status' => $res['status'],
            'message' => $res['message'],
            'favorites' => $res['favorites'],
            'count' => count($res['favorites']),
        ]);
    }
}
