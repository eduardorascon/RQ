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
			'tag'=> 'TORO1',
			'purchase_date' => $now,
			'birth' => $now,
			'gender' => 'Macho',
			'is_alive' => 'No',
			'breed_id' => 1]);

        DB::table('cattle')->insert([
			'tag'=> 'TORO2',
			'purchase_date' => $now,
			'birth' => $now,
			'gender' => 'Macho',
			'is_alive' => 'No',
			'breed_id' => 2]);

        DB::table('cattle')->insert([
			'tag'=> 'VACA1',
			'purchase_date' => $now,
			'birth' => $now,
			'gender' => 'Hembra',
			'is_alive' => 'No',
			'breed_id' => 3]);

        DB::table('cattle')->insert([
			'tag'=> 'VACA2',
			'purchase_date' => $now,
			'birth' => $now,
			'gender' => 'Hembra',
			'is_alive' => 'No',
			'breed_id' => 1]);

        DB::table('cattle')->insert([
			'tag'=> 'VACA3',
			'purchase_date' => $now,
			'birth' => $now,
			'gender' => 'Hembra',
			'is_alive' => 'No',
			'breed_id' => 2]);
    }
}
