<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flat extends Model
{
    use HasFactory;

    protected $fillable = [
        'floor',
        'max_people',
        'balcony',
        'price'
    ];

    public function buildings()
    {
        return $this->hasMany(Building::class);
    }
}
