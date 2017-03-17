<?php

use Illuminate\Database\Seeder;

class BullsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = date('Y-m-d H:i:s', strtotime('now'));

        DB::table('bulls')->insert([
			'cattle_id'=> 1,
			'created_at' => $now,
			'updated_at' => $now]);

        DB::table('bulls')->insert([
            'cattle_id'=> 2,
            'created_at' => $now,
            'updated_at' => $now]);
    }
}
