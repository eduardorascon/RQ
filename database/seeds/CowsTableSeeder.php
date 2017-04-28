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
            'number_of_calves'=> 0,
			'cattle_id'=> 3]);

        DB::table('cows')->insert([
            'is_fertile'=> 'Si',
            'pregnancy_status'=> 'Parida',
            'number_of_calves'=> 0,
            'cattle_id'=> 4]);

        DB::table('cows')->insert([
            'is_fertile'=> 'No',
            'pregnancy_status'=> 'Vacia',
            'number_of_calves'=> 0,
            'cattle_id'=> 5]);
    }
}
