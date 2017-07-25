<?php

use Illuminate\Database\Seeder;

class CalvesTableSeeder extends Seeder
{
    public function run()
    {
        Eloquent::unguard();
        DB::disableQueryLog();
        $path = 'database/seeds/sql/calves.sql';
        DB::unprepared(file_get_contents($path));
    }
}
