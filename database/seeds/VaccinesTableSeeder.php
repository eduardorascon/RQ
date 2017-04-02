<?php

use Illuminate\Database\Seeder;

class VaccinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vaccines = ['Vacuna 1','Vacuna 2','Vacuna 3'];

        array_map(function($name){
        	DB::table('vaccines')->insert([
        			'name'=>$name]);
        }, $vaccines);
    }
}
