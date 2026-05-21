<?php

namespace App\Listeners;

use App\Services\CartService;
use App\Services\WishlistService;
use Illuminate\Auth\Events\Login;

class MergeGuestCartAndFavorites
{
    /**
     * Handle the event when a user logs in.
     */
    public function handle(Login $event): void
    {
        $user = $event->user;
        CartService::mergeGuestCart($user);
        WishlistService::mergeGuestFavorites($user);
    }
}
