<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Architect extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'skills',
        'title'
    ];

    public function buildings()
    {
        return $this->hasMany(Building::class);
    }
}
