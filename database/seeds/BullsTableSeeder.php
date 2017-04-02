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
        DB::table('bulls')->insert([
			'cattle_id'=> 1]);

        DB::table('bulls')->insert([
            'cattle_id'=> 2]);
    }
}
