<?php

namespace App\Services;

use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class WishlistService
{
    /**
     * Get all favorites.
     */
    public static function getFavorites(): array
    {
        if (Auth::check()) {
            return Auth::user()->favorites()->get()->map(function ($item) {
                return [
                    'id' => $item->id,
                    'product_id' => $item->product_id,
                    'product' => $item->product,
                ];
            })->toArray();
        }

        $sessionFavorites = session()->get('favorites', []);
        $favorites = [];
        foreach ($sessionFavorites as $productId) {
            $product = Product::allStatic()->firstWhere('id', $productId);
            if ($product) {
                $favorites[] = [
                    'id' => $productId,
                    'product_id' => $productId,
                    'product' => $product,
                ];
            }
        }
        return $favorites;
    }

    /**
     * Toggle favorite status.
     */
    public static function toggle(int $productId): array
    {
        $status = 'removed';
        $message = 'Produit retiré des favoris.';

        if (Auth::check()) {
            $favorite = Auth::user()->favorites()->where('product_id', $productId)->first();
            if ($favorite) {
                $favorite->delete();
            } else {
                Auth::user()->favorites()->create([
                    'product_id' => $productId,
                ]);
                $status = 'added';
                $message = 'Produit ajouté aux favoris !';
            }
        } else {
            $favorites = session()->get('favorites', []);
            if (in_array($productId, $favorites)) {
                $favorites = array_values(array_filter($favorites, fn($id) => $id != $productId));
                session()->put('favorites', $favorites);
            } else {
                $favorites[] = $productId;
                session()->put('favorites', $favorites);
                $status = 'added';
                $message = 'Produit ajouté aux favoris !';
            }
        }

        return [
            'status' => $status,
            'message' => $message,
            'favorites' => self::getFavorites(),
        ];
    }

    /**
     * Get favorites count.
     */
    public static function getWishlistCount(): int
    {
        return count(self::getFavorites());
    }

    /**
     * Merge guest favorites into user favorites.
     */
    public static function mergeGuestFavorites($user): void
    {
        $sessionFavorites = session()->get('favorites', []);
        foreach ($sessionFavorites as $productId) {
            $exists = $user->favorites()->where('product_id', $productId)->exists();
            if (!$exists) {
                $user->favorites()->create([
                    'product_id' => $productId,
                ]);
            }
        }
        session()->forget('favorites');
    }
}
