<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'city',
        'date_built',
        'architect_id',
        'flat_id'
    ];

    public function architect()
    {
        return $this->belongsTo(Architect::class);
    }

    public function flat()
    {
        return $this->belongsTo(Flat::class);
    }
}
