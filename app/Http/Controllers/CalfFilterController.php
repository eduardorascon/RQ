<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Calf;
use App\Cattle;
use App\Breed;
use App\Owner;
use App\Paddock;
use App\Cow;

class CalfFilterController extends Controller
{
    public function index(Request $request)
    {
    	if($_GET == false)
    		$calves = Calf::select('calves.*')->
    			join('cattle', 'calves.cattle_id', '=', 'cattle.id')->
    			orderBy('cattle.tag', 'asc');
    	else
    	{
    		$calves = (new Calf)->newQuery()->select('calves.*')->
    			join('cattle', 'calves.cattle_id', '=', 'cattle.id');

            //search by calf mother
            if($request->has('cow_id'))
                $calves->where('calves.cow_id', $request->cow_id);

            //search by cattle tag
            if($request->has('cattle_tag'))
                $calves->where('cattle.tag', $request->cattle_tag)->orWhere('cattle.tag', 'like', '%' . $request->cattle_tag . '%');

            //search by cattle birth
            if($request->has('cattle_birth_since') && $request->has('cattle_birth_until'))
                $calves->whereBetween('cattle.birth', array($request->cattle_birth_since, $request->cattle_birth_until));

            //search by cattle purchase date
            if($request->has('cattle_purchase_date_since') && $request->has('cattle_purchase_date_until'))
                $calves->whereBetween('cattle.purchase_date', array($request->cattle_purchase_date_since, $request->cattle_purchase_date_until));

            //search by cattle breed
            if($request->has('cattle_breed'))
                $calves->where('cattle.breed_id', $request->cattle_breed);

            //search by cattle owner
            if($request->has('cattle_owner'))
                $calves->where('cattle.owner_id', $request->cattle_owner);

            //search by cattle paddock
            if($request->has('cattle_paddock'))
                $calves->where('cattle.paddock_id', $request->cattle_paddock);

            //search by cattle is_alive
            if($request->has('cattle_is_alive'))
                $calves->where('cattle.is_alive', $request->cattle_is_alive);

            $calves->orderBy('cattle.tag', 'asc');
    	}

    	$cattle = Calf::select('cattle.*')->
            join('cattle', 'calves.cattle_id', '=', 'cattle.id');

        $cow_list = Cow::whereHas('cattle', function ($q) {
            $q->orderBy('tag', 'asc');
        })->with('cattle')->get();

    	return view('calf_filters.index', [
    		'calves' => $calves->paginate(12),
            'cow_list' => $cow_list,
            'birth_since' => $cattle->min('birth'),
            'birth_until' => $cattle->max('birth'),
            'purchase_since' => $cattle->min('purchase_date'),
            'purchase_until' => $cattle->max('purchase_date'),
    		'breed_list' => Breed::orderBy('name', 'asc')->get(),
            'owner_list' => Owner::orderBy('name', 'asc')->get(),
            'paddock_list' => Paddock::orderBy('name', 'asc')->get()
    	]);
    }
}
