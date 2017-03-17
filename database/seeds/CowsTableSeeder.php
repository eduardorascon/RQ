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
			'cattle_id'=> 3,
			'created_at' => $now,
			'updated_at' => $now]);

        DB::table('cows')->insert([
            'cattle_id'=> 4,
            'created_at' => $now,
            'updated_at' => $now]);

        DB::table('cows')->insert([
            'cattle_id'=> 5,
            'created_at' => $now,
            'updated_at' => $now]);
    }
}
