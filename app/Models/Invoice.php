<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'total',
        'vat_percentage',
        'vat_amount',
        'payable',
        'cus_details',
        'ship_details',
        'tran_id',
        'delivery_status',
        'payment_status',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function invoiceProduct(): HasMany
    {
        return $this->hasMany(InvoiceProduct::class);
    }
}
