<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    public function run()
    {
    	Eloquent::unguard();
        DB::disableQueryLog();
        $path = 'database/seeds/sql/clients.sql';
        DB::unprepared(file_get_contents($path));
    }
}
