<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_date',
        'invoice_no',
        'customer_name',
        'phone',
        'email',
        'billing_address',
        'shipping_address',
        'total',
        'note',
        'status',
        'merchant_name',
    ];
    
    protected $casts = [
        'invoice_date' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function items(): HasMany
    {
        return $this->hasMany(InvoiceItem::class);
    }
}
