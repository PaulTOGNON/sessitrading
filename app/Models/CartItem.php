<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    protected $fillable = ['user_id', 'session_id', 'product_id', 'quantity'];

    /**
     * Get the user that owns the cart item.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the corresponding static product.
     */
    public function getProductAttribute(): ?Product
    {
        return Product::allStatic()->firstWhere('id', $this->product_id);
    }

    /**
     * Include product attribute in JSON representation.
     */
    protected $appends = ['product'];
}
