<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Breed;

class BreedController extends Controller
{
    public function index()
    {
    	return Breed::all();
    }

 	public function getBreed($id)
    {
		return Breed::findOrFail($id);
    }

    public function store(Request $request)
    {

    }

    public function update(Request $request)
    {

    }

}
