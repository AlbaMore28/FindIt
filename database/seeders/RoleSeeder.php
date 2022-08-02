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

        /* Permission::create(['name' => 'home.faq'])->assignRole($role1);
        Permission::create(['name' => 'objetosBuscados.show'])->syncRoles([$role1, $role2]); */



    }
}