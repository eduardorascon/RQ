<?php

use Illuminate\Database\Seeder;

class CowsTableSeeder extends Seeder
{

    public function run()
    {
        $now = date('Y-m-d H:i:s', strtotime('now'));

        DB::table('cows')->insert([
            'is_fertile'=> 'Si',
            'pregnancy_status'=> 'Preñada',
			'cattle_id'=> 3]);

        DB::table('cows')->insert([
            'is_fertile'=> 'Si',
            'pregnancy_status'=> 'Parida',
            'cattle_id'=> 4]);

        DB::table('cows')->insert([
            'is_fertile'=> 'No',
            'pregnancy_status'=> 'Vacia',
            'cattle_id'=> 5]);
    }
}
