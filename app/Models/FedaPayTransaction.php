<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FedaPayTransaction extends Model
{
    use HasFactory;

    protected $table = 'fedapay_transactions';

    protected $fillable = [
        'order_id',
        'transaction_id',
        'reference',
        'amount',
        'currency',
        'status',
        'payment_method',
        'raw_response',
    ];

    /**
     * Get the order associated with this transaction.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
