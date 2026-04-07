<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
    public function criteria()
    {
        return $this->belongsTo(Criteria::class);
    }
}
