<?php

use Illuminate\Database\Seeder;

class PaddocksTableSeeder extends Seeder
{
    public function run()
    {
        Eloquent::unguard();
        DB::disableQueryLog();
        $path = 'database/seeds/sql/paddocks.sql';
        DB::unprepared(file_get_contents($path));
    }
}
