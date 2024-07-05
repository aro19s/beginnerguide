<?php

namespace Database\Seeders;

use App\Models\Films\Movie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Usando el modelo User
        Movie::create([
            'title' => 'Título1',
            'duration' => '100',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Usando el modelo User
        Movie::create([
            'title' => 'Título2',
            'duration' => '115',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Movie::create([
            'title' => 'Título3',
            'duration' => '130',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
