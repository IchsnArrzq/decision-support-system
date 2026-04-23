<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Criteria extends Model
{
    protected $fillable = [
        'code',
        'name',
        'indicator',
        'unit',
        'weight',
        'type',
    ];

    protected $casts = [
        'weight' => 'float',
    ];

    public function values(): HasMany
    {
        return $this->hasMany(Value::class);
    }
}
