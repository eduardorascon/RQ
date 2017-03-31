<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Calf;

class CalfSaleController extends Controller
{
    public function index()
    {
    	$calves = Calf::all();

		$is_search = isset($_GET['s']);
    	if($is_search)
    	{
    		$calves = Calf::whereHas('cattle', function ($q) {
    			$q->where('tag', 'LIKE', '%' . $_GET['s'] . '%');
    		})->get();
    	}

    	return view('calves_sales.index', ['calves' => $calves]);
    }
}
