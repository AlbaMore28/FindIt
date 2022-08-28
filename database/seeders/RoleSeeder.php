<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* $role1 = Role::create(['name' => 'Administrador']);
        $role2 = Role::create(['name' => 'Moderador']);
        $role3 = Role::create(['name' => 'ColaboradorBeneficiario']); */
        $role1 = Role::findByName('Administrador');
        $role2 = Role::findByName('Moderador');

        /* Permisos para Administrador y Moderador */
        Permission::create(['name' => 'admin.usuarios.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.objetos.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'api.usuarios.cambiarEstadoBloqueado'])->syncRoles([$role1, $role2]);

        /* Permisos sólo para Administrador */
        Permission::create(['name' => 'admin.usuarios.destroy'])->assignRole($role1);
        Permission::create(['name' => 'api.usuarios.cambiarRol'])->assignRole($role1);
    }
}
