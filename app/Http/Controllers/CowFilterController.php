<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cow;

class CowFilterController extends Controller
{
    public function index()
    {
    	$cows = Cow::paginate(12);
    	return view('cow_filters.index', ['cows' => $cows]);
    }
}