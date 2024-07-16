<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use function Ramsey\Uuid\v1;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Usando el modelo User
        $user1 = User::create([
            'name' => 'Sofía',
            'email' => 'sofia_admin@email.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);
        $user1->assignRole('admin');

        // Usando el modelo User
        $user2 = User::create([
            'name' => 'Usuario Modelo',
            'email' => 'model@email.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);
        $user2->assignRole('user');
    }
}
