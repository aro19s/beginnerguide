<?php

namespace Database\Seeders;

use App\Models\Films\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Usando el modelo User
        Genre::create([
            'genre' => 'Género1',
            'genre_description' => 'Description1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Usando el modelo User
        Genre::create([
            'genre' => 'Género2',
            'genre_description' => 'Description2',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Genre::create([
            'genre' => 'Género3',
            'genre_description' => 'Description3',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
