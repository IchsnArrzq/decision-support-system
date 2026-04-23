<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Alternative extends Model
{
    protected $fillable = [
        'code',
        'name',
        'brand',
        'category',
        'transmission',
        'price',
    ];

    protected $casts = [
        'price' => 'float',
    ];

    public function values(): HasMany
    {
        return $this->hasMany(Value::class);
    }
}
