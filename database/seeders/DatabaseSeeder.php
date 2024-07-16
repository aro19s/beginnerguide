<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Llama al seeder que deseas ejecutar
        $this->call([
            RolesAndPermissionsSeeder::class,
            FilmRolesAndPermissionsSeeder::class,
            FilmUsersTableSeeder::class,
            UsersTableSeeder::class,
            MoviesTableSeeder::class,
            GenresTableSeeder::class,
            MovieGenreTableSeeder::class,
        ]);
    }
}
