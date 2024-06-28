<?php

namespace App\Models\Films;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'duration'];
    protected $table = 'Movies';

    public function genres()
    {
        return $this->belongsToMany(Genre::class,'movie_genre','movie_id','genre_id')
            ->withPivot('extra_info')
            ->withTimestamps();
    }
}
