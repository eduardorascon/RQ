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

 	public function show($id)
    {
		return Client::findOrFail($id);
    }
	
	public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
    	$this->validate($request,[
		      'first_name'=> 'required',
		      'last_name' => 'required',
		      'address' => 'required',
		      'company' => 'required',
		      'phone' => 'required'
		    ]);
    	Client::create([
    		'first_name' => $request->input('first_name'),
    		'last_name' => $request->input('last_name'),
    		'address' => $request->input('address'),
    		'company' => $request->input('company'),
    		'phone' => $request->input('phone')
    		]);
    	return redirect()->route('clients');
    }

    public function edit($id){
    	$client = Client::findOrFail($id);
    	return view("clients.edit", compact('client'));
    }

    public function update(Request $request, $id)
    {
    	$client = Client::findOrFail($id);

    	$client->update([
    			'first_name' => $request->input('first_name'),
	    		'last_name' => $request->input('last_name'),
	    		'address' => $request->input('address'),
	    		'company' => $request->input('company'),
	    		'phone' => $request->input('phone')
    		]);
    	return redirect()->route('clients');
    }

    public function destroy($id){
    	$client = Client::findOrFail($id);
    	$client->delete();
    	return redirect()->route('clients');
    }
}
