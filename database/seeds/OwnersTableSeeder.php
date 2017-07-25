<?php

use Illuminate\Database\Seeder;

class OwnersTableSeeder extends Seeder
{
    public function run()
    {
        Eloquent::unguard();
        DB::disableQueryLog();
        $path = 'database/seeds/sql/owners.sql';
        DB::unprepared(file_get_contents($path));
    }
}
