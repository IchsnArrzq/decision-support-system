<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Value extends Model
{
    protected $fillable = [
        'alternative_id',
        'criteria_id',
        'value',
    ];

    protected $casts = [
        'value' => 'float',
    ];

    public function criteria(): BelongsTo
    {
        return $this->belongsTo(Criteria::class);
    }

    public function alternative(): BelongsTo
    {
        return $this->belongsTo(Alternative::class);
    }
}
