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
        	$now = date('Y-m-d H:i:s', strtotime('now'));

        	DB::table('vaccines')->insert([
        			'name'=>$name,
        			'created_at' => $now,
        			'updated_at' => $now
        		]);
        }, $vaccines);
    }
}
