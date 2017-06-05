<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    public function run()
    {
        $role_user = new Role();
        $role_user->name = 'User';
        $role_user->description = 'A regular user';
        $role_user->save();

        $role_admin = new Role();
        $role_admin->name = 'Admin';
        $role_admin->description = 'An administration user';
        $role_admin->save();

        $role_salesman = new Role();
        $role_salesman->name = 'Salesman';
        $role_salesman->description = 'A sales user';
        $role_salesman->save();
    }
}
