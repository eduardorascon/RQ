<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        $role_user = Role::where('name', 'User')->first();
        $role_admin = Role::where('name', 'Admin')->first();
        $role_salesman = Role::where('name', 'Salesman')->first();

        $user = new User();
        $user->name = 'Luis Rascon';
        $user->email = 'luis@ejemplo.com';
        $user->password = bcrypt('user');
        $user->save();
        $user->roles()->attach($role_user);

        $admin = new User();
        $admin->name = 'Marco Quezada';
        $admin->email = 'marco@ejemplo.com';
        $admin->password = bcrypt('admin');
        $admin->save();
        $admin->roles()->attach($role_admin);

        $salesman = new User();
        $salesman->name = 'Jorge Mendoza';
        $salesman->email = 'jorge@ejemplo.com';
        $salesman->password = bcrypt('salesman');
        $salesman->save();
        $salesman->roles()->attach($role_salesman);
    }
}
