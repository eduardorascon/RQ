<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;

class ClientController extends Controller
{
	
    public function index()
    {
		return Client::all();
    }

 	public function getClient($id)
    {
		return Client::findOrFail($id);
    }


    public function store(Request $request)
    {

    }

    public function update(Request $request)
    {

    }
}
