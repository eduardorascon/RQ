<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
    	$this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        //catalogs
        $this->call(BreedsTableSeeder::class);
        $this->call(ClientsTableSeeder::class);
        $this->call(OwnersTableSeeder::class);
        $this->call(PaddocksTableSeeder::class);
        $this->call(VaccinesTableSeeder::class);
        //data
        $this->call(CattleTableSeeder::class);
        $this->call(CowsTableSeeder::class);
        $this->call(CalvesTableSeeder::class);
        $this->call(BullsTableSeeder::class);
        //logs
        $this->call(WeightLogsTableSeeder::class);
    }
}
