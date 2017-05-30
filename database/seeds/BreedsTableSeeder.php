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
        $breeds = ['CORRIENTES', 'BRANGUS'];

        array_map(function($name){
        	DB::table('breeds')->insert([
        			'name'=>$name
        		]);
        }, $breeds);
    }
}
