<?php

use Illuminate\Database\Seeder;

class BullsTableSeeder extends Seeder
{

    public function run()
    {
        Eloquent::unguard();
        DB::disableQueryLog();
        $path = 'database/seeds/sql/bulls.sql';
        DB::unprepared(file_get_contents($path));
    }
}
