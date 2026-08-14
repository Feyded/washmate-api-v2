<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItemProduct extends Model
{
    protected $fillable = [
        'order_item_id',
        'product_id',
        'product_name',
        'unit_price',
        'quantity',
        'is_addon',
    ];

    public function OrderItem(): BelongsTo
    {
        return $this->belongsTo(OrderItem::class);
    }
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
