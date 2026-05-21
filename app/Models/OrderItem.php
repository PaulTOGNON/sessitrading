<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'price',
        'quantity',
    ];

    /**
     * Get the order that this item belongs to.
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
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
