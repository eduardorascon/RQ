<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->first_name = 'Luis';
        $user->last_name = 'Rascon';
        $user->email = 'luis@ejemplo.com';
        $user->password = bcrypt('user');
        $user->save();

        $admin = new User();
        $admin->first_name = 'Marco';
        $admin->last_name = 'Quezada';
        $admin->email = 'marco@ejemplo.com';
        $admin->password = bcrypt('admin');
        $admin->save();

        $salesman = new User();
        $salesman->first_name = 'Jorge';
        $salesman->last_name = 'Mendoza';
        $salesman->email = 'jorge@ejemplo.com';
        $salesman->password = bcrypt('salesman');
        $salesman->save();
    }
}
