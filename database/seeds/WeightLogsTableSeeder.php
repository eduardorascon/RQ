<?php

use Illuminate\Database\Seeder;

class WeightLogsTableSeeder extends Seeder
{
    public function run()
    {
        Eloquent::unguard();
        DB::disableQueryLog();
        $path = 'database/seeds/sql/weight_logs.sql';
        DB::unprepared(file_get_contents($path));
    }
}
