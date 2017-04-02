<?php

use Illuminate\Database\Seeder;

class CattleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = date('Y-m-d H:i:s', strtotime('now'));

        DB::table('cattle')->insert([
			'tag'=> 'TAG 1',
			'purchase_date' => $now,
			'birth' => $now,
			'breed_id' => 1]);

        DB::table('cattle')->insert([
			'tag'=> 'TAG 2',
			'purchase_date' => $now,
			'birth' => $now,
			'breed_id' => 2]);

        DB::table('cattle')->insert([
			'tag'=> 'TAG 3',
			'purchase_date' => $now,
			'birth' => $now,
			'breed_id' => 3]);

        DB::table('cattle')->insert([
			'tag'=> 'TAG 4',
			'purchase_date' => $now,
			'birth' => $now,
			'breed_id' => 1]);

        DB::table('cattle')->insert([
			'tag'=> 'TAG 5',
			'purchase_date' => $now,
			'birth' => $now,
			'breed_id' => 2]);
    }
}
