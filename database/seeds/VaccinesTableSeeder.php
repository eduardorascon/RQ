<?php

use Illuminate\Database\Seeder;

class VaccinesTableSeeder extends Seeder
{
    public function run()
    {
        Eloquent::unguard();
        DB::disableQueryLog();
        $path = 'database/seeds/sql/vaccines.sql';
        DB::unprepared(file_get_contents($path));
    }
}
