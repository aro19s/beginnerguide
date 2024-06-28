<?php

namespace App\Models\Films;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $fillable = ['movie_genre', 'genre_description'];
    protected $table = 'Genres';

    public function movies()
    {
        return $this->belongsToMany(Movie::class,'movie_genre','genre_id','movie_id')
            ->withPivot('extra_info')
            ->withTimestamps();
    }
}
