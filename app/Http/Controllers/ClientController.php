<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUpdateClientRequest;
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

    public function store(StoreUpdateClientRequest $request)
    {
    	Client::create([
    		'first_name' => $request->input('first_name'),
    		'last_name' => $request->input('last_name'),
    		'address' => $request->input('address'),
    		'company' => $request->input('company'),
    		'phone' => $request->input('phone')
    		]);
    	return redirect()->route('clients.index');
    }

    public function edit($id){
    	$client = Client::findOrFail($id);
    	return view("clients.edit", compact('client'));
    }

    public function update(StoreUpdateClientRequest $request, $id)
    {
    	$client = Client::findOrFail($id);

    	$client->update([
    			'first_name' => $request->input('first_name'),
	    		'last_name' => $request->input('last_name'),
	    		'address' => $request->input('address'),
	    		'company' => $request->input('company'),
	    		'phone' => $request->input('phone')
    		]);
    	return redirect()->route('clients.index');
    }

    public function destroy($id)
    {
        try{
            $client = Client::findOrFail($id);
            $client->delete();
        }
        catch(\Exception $e)
        {
            $errors = array('El registro no puede ser eliminado.');
        }

    	return redirect()->route('clients.index');
    }
}
