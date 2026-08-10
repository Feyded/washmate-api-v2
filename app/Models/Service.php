<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name', 'price'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'service_products')
            ->withPivot('quantity')
            ->withTimestamps();
    }
}
