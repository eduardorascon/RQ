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
        	DB::table('breeds')->insert([
        			'name'=>$name
        		]);
        }, $breeds);
    }
}
