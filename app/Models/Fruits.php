<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fruits extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'amount',
        'price',
        'type'
    ];

}