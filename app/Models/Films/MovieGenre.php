<?php

namespace App\Models\Films;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieGenre extends Model
{
    use HasFactory;

    protected $table = 'movie_genre';
    protected $fillable = ['movie_id', 'genre_id', 'extra_info'];
}
