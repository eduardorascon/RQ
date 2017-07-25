<?php

use Illuminate\Database\Seeder;

class BreedsTableSeeder extends Seeder
{
    public function run()
    {
        Eloquent::unguard();
        DB::disableQueryLog();
        $path = 'database/seeds/sql/breeds.sql';
        DB::unprepared(file_get_contents($path));
    }
}
