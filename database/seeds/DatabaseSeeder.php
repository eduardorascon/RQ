<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        //USED
        //$this->call(BreedsTableSeeder::class);
        $this->call(ClientsTableSeeder::class);

    }
}
