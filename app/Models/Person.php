<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    protected $table = 'person';
    protected $fillable = [
        'first_name',
        'last_name',
        'age',
        'email',
        'phone',
    ];
}
