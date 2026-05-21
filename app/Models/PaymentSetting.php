<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentSetting extends Model
{
    use HasFactory;

    protected $table = 'payment_settings';

    protected $fillable = [
        'is_enabled',
        'environment',
        'public_key',
        'secret_key',
        'webhook_secret',
        'currency',
    ];

    protected $casts = [
        'is_enabled' => 'boolean',
    ];

    /**
     * Get the active settings singleton.
     */
    public static function getSettings(): self
    {
        return self::firstOrCreate(
            ['id' => 1],
            [
                'is_enabled' => false,
                'environment' => 'sandbox',
                'public_key' => null,
                'secret_key' => null,
                'webhook_secret' => null,
                'currency' => 'XOF',
            ]
        );
    }
}
