<?php

use Illuminate\Database\Seeder;

class TableViewsSeeder extends Seeder
{
    public function run()
    {
        Eloquent::unguard();
        DB::disableQueryLog();
        $path = 'database/seeds/sql/table_views.sql';
        DB::unprepared(file_get_contents($path));
    }
}
