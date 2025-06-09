<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolesAndPermissionsSeeder extends Seeder
{

    public function run(): void
    {
        // Limpa caches de permissões para evitar problemas
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Criar permissões
        Permission::create(['name' => 'edit articles']);
        Permission::create(['name' => 'delete articles']);
        Permission::create(['name' => 'publish articles']);
        Permission::create(['name' => 'unpublish articles']);

        // Criar roles e atribuir permissões
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleAdmin->givePermissionTo(Permission::all());

        $roleEditor = Role::create(['name' => 'editor']);
        $roleEditor->givePermissionTo(['edit articles', 'publish articles']);

        $roleUser = Role::create(['name' => 'user']);
        // user sem permissões específicas
    }
}
