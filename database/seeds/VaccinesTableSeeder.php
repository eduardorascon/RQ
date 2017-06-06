<?php

use Illuminate\Database\Seeder;

class VaccinesTableSeeder extends Seeder
{
    public function run()
    {
        $vaccines = ['Vacuna 1','Vacuna 2','Vacuna 3'];

        array_map(function($name){
        	DB::table('vaccines')->insert([
        			'name'=>$name]);
        }, $vaccines);
    }
}
