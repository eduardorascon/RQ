<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUpdateBreedRequest;
use App\Breed;
use View;

class BreedController extends Controller
{
    public function index()
    {
		$breeds = Breed::all();
		return view('breeds.index', ['breeds' => $breeds]);
    }

 	public function show($id)
    {
		return Client::findOrFail($id);
    }

	public function create()
    {
        return view('breeds.create');
    }

    public function store(StoreUpdateBreedRequest $request)
    {
    	Breed::create(['name' => $request->input('name')]);
    	return redirect()->route('breeds.index');
    }

    public function edit($id){
    	$breed = Breed::findOrFail($id);
    	return view("breeds.edit", compact('breed'));
    }

    public function update(StoreUpdateBreedRequest $request, $id)
    {
    	$breed = Breed::findOrFail($id);
    	$breed->update(['name' => $request->input('name')]);
    	return redirect()->route('breeds.index');
    }

    public function destroy($id){
    	$breed = Breed::findOrFail($id);
    	$breed->delete();
    	return redirect()->route('breeds.index');
    }
}
