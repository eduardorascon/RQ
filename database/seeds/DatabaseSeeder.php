<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
    	$this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        /*$this->call(ClientsTableSeeder::class);
        $this->call(BreedsTableSeeder::class);
        $this->call(CattleTableSeeder::class);
        $this->call(CowsTableSeeder::class);
        $this->call(BullsTableSeeder::class);
        $this->call(VaccinesTableSeeder::class);
        */
    }
}
