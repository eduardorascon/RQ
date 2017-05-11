<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bull;
use App\Cattle;
use App\Breed;

class BullFilterController extends Controller
{
    public function index(Request $request)
    {
    	if($_GET == false)
    		$bulls = Bull::join('cattle', 'bulls.cattle_id', '=', 'cattle.id')->
    			orderBy('cattle.tag', 'asc');
    	else
    	{
    		$bulls = (new Bull)->newQuery()->
    			join('cattle', 'bulls.cattle_id', '=', 'cattle.id');

            $bulls->orderBy('cattle.tag', 'asc');
    	}

    	return view('bull_filters.index', [
    		'bulls' => $bulls->paginate(12),
    		'breed_list' => Breed::orderBy('name', 'asc')->get()
    	]);
    }
}
