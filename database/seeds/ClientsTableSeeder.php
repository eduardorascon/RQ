<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    public function run()
    {
    	$now = date('Y-m-d H:i:s', strtotime('now'));

        DB::table('clients')->insert([
        			'first_name'=>'Jorge', 
        			'last_name'=>'Mendoza Guillen', 
        			'address'=>'Pino 4044 col Quintas', 
        			'phone'=>'6141234567', 
        			'company'=>'Cff nd Subs']);
        DB::table('clients')->insert([
        			'first_name'=>'Eduardo', 
        			'last_name'=>'Rascon Fierro', 
        			'address'=>'Sup 4488 col San Felipe', 
        			'phone'=>'6149876542', 
        			'company'=>'Tds los bts']);
        DB::table('clients')->insert([
        			'first_name'=>'Guillermo', 
        			'last_name'=>'Dominguez Dominguez', 
        			'address'=>'Calle 7845 Col San Felipe', 
        			'phone'=>'6141457895', 
        			'company'=>'Mattra']);
    }
}
