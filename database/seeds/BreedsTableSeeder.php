<?php

use Illuminate\Database\Seeder;

class BreedsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $breeds = ['Holstein','Angus','Hereford'];

        array_map(function($name){
        	$now = date('Y-m-d H:i:s', strtotime('now'));

        	DB::table('breeds')->insert([
        			'name'=>$name, 
        			'created_at' => $now,
        			'updated_at' => $now
        		]);
        }, $breeds);
    }
}
