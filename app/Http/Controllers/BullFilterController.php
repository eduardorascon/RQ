<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bull;
use App\Cattle;
use App\Breed;
use App\Owner;
use App\Paddock;

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

            //search by cattle owner
            if($request->has('cattle_owner'))
                $bulls->where('cattle.owner_id', $request->cattle_owner);

            //search by cattle paddock
            if($request->has('cattle_paddock'))
                $bulls->where('cattle.paddock_id', $request->cattle_paddock);

            //search by cattle is_alive
            if($request->has('cattle_is_alive'))
                $bulls->where('cattle.is_alive', $request->cattle_is_alive);

            $bulls->orderBy('cattle.tag', 'asc');
    	}

    	return view('bull_filters.index', [
    		'bulls' => $bulls->paginate(12),
    		'breed_list' => Breed::orderBy('name', 'asc')->get(),
            'owner_list' => Owner::orderBy('name', 'asc')->get(),
            'paddock_list' => Paddock::orderBy('name', 'asc')->get()
    	]);
    }
}
