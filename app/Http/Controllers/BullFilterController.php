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
    		$bulls = Bull::select('bulls.*')->
                join('cattle', 'bulls.cattle_id', '=', 'cattle.id')->
    			orderBy('cattle.tag', 'asc');
    	else
    	{
    		$bulls = (new Bull)->newQuery()->select('bulls.*')->
    			join('cattle', 'bulls.cattle_id', '=', 'cattle.id');

            //search by cattle tag
            if($request->has('cattle_tag'))
                $bulls->where('cattle.tag', $request->cattle_tag);

            //search by cattle breed
            if($request->has('cattle_breed'))
                $bulls->where('cattle.breed_id', $request->cattle_breed);

            //search by cattle is_alive
            if($request->has('cattle_is_alive'))
                $bulls->where('cattle.is_alive', $request->cattle_is_alive);

            $bulls->orderBy('cattle.tag', 'asc');
    	}

    	return view('bull_filters.index', [
    		'bulls' => $bulls->paginate(12),
    		'breed_list' => Breed::orderBy('name', 'asc')->get()
    	]);
    }
}
