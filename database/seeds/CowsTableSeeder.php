<?php

use Illuminate\Database\Seeder;

class CowsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = date('Y-m-d H:i:s', strtotime('now'));

        DB::table('cows')->insert([
            'is_fertile'=> 'Si',
			'cattle_id'=> 3]);

        DB::table('cows')->insert([
            'is_fertile'=> 'No',
            'cattle_id'=> 4]);

        DB::table('cows')->insert([
            'is_fertile'=> 'Si',
            'cattle_id'=> 5]);
    }
}
