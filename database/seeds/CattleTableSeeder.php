<?php

use Illuminate\Database\Seeder;

class CattleTableSeeder extends Seeder
{
    public function run()
    {
    	Eloquent::unguard();
    	DB::disableQueryLog();
    	$path = 'database/seeds/sql/cattle.sql';
    	DB::unprepared(file_get_contents($path));
    }
}
