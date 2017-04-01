<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Calf;

class CalfSaleController extends Controller
{
    public function index()
    {
    	$calves = Calf::paginate(12);

		$is_search = isset($_GET['s']);
    	if($is_search)
    	{
    		$calves = Calf::whereHas('cattle', function ($q) {
    			$q->where('tag', 'LIKE', '%' . $_GET['s'] . '%');
    		})->get()->paginate(12);
    	}

    	return view('calves_sales.index', ['calves' => $calves]);
    }
}
