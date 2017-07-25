<?php

use Illuminate\Database\Seeder;

class CowsTableSeeder extends Seeder
{
    public function run()
    {
        Eloquent::unguard();
        DB::disableQueryLog();
        $path = 'database/seeds/sql/cows.sql';
        DB::unprepared(file_get_contents($path));
    }
}
