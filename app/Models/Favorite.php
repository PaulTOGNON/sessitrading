<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Favorite extends Model
{
    protected $fillable = ['user_id', 'product_id'];

    /**
     * Get the user that owns the favorite.
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
