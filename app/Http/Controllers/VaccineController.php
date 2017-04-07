<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vaccine;

class VaccineController extends Controller
{
    public function index()
    {
		$vaccines = Vaccine::all();
		return view('vaccines.index', ['vaccines' => $vaccines]);
    }

 	public function show($id)
    {
    	//
    }

	public function create()
    {
        return view('vaccines.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, ['name'=> 'required']);

    	$vaccine = new Vaccine;
    	$vaccine->name = $request->name;
    	$vaccine->save();
    	return redirect()->route('vaccines.index');
    }

    public function edit($id)
    {
    	$vaccine = Vaccine::findOrFail($id);
    	return view('vaccines.edit', [
    		'vaccine'=>$vaccine]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, ['name'=> 'required']);

    	$vaccine = Vaccine::findOrFail($id);
    	$vaccine->name = $request->name;
    	$vaccine->update();

    	return redirect()->route('vaccines.index');
    }

    public function destroy($id)
    {
    	$vaccine = Vaccine::findOrFail($id);
    	$vaccine->delete();
    	return redirect()->route('vaccines.index');
    }
}
