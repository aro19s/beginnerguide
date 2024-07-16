<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class FilmRolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Resetea el caché de roles y permisos
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Crea permisos
        Permission::create(['name' => 'api para admin']);
        Permission::create(['name' => 'api para general']);


        // Al Rol admin le daremos todos los permisos
        $role = Role::create(['name' => 'director']);
        $role->givePermissionTo(Permission::all());

        // Creamos un rol 'user' y le asignamos sólo un permiso
        $role = Role::create(['name' => 'actor']);
        $role->givePermissionTo('api para general');
    }
}
