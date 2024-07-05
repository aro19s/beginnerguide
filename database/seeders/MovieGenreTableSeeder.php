<?php

namespace Database\Seeders;

use App\Models\Films\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MovieGenreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Asegúrate de que las películas y géneros existan
        $movieIds = DB::table('movies')->pluck('id');
        $genreIds = DB::table('genres')->pluck('id');

        // Asignar géneros a películas
        foreach ($movieIds as $movieId) {
            // Asignar aleatoriamente entre 1 y 3 géneros a cada película
            $assignedGenres = $genreIds->random(rand(1, 3));

            foreach ($assignedGenres as $genreId) {
                DB::table('movie_genre')->insert([
                    'movie_id' => $movieId,
                    'genre_id' => $genreId,
                    'extra_info' => 'Extra info for movie ' . $movieId . ' and genre ' . $genreId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
