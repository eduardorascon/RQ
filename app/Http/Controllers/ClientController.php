<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use View;

class ClientController extends Controller
{
	
    public function index()
    {
		$clients = Client::all();
		
		return view('clients.index', ['clients' => $clients]);
    }

 	public function getClient($id)
    {
		return Client::findOrFail($id);
    }


    public function store(Request $request)
    {
    	return Client::create([
    		'first_name' => $request->input('name'),
    		'last_name' => $request->input('name'),
    		'address' => $request->input('name'),
    		'company' => $request->input('name'),
    		'phone' => $request->input('name')
    		]);
    }

    public function update(Request $request, $id)
    {
    	$client = Client::findOrFail($id);

    	$client->update([
    			'first_name' => $request->input('name'),
	    		'last_name' => $request->input('name'),
	    		'address' => $request->input('name'),
	    		'company' => $request->input('name'),
	    		'phone' => $request->input('name')
    		]);
    }
}
