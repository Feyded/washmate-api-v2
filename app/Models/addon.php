<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class addon extends Model
{
    protected $fillable = ['is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
