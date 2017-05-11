<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cow;
use App\Cattle;
use App\Breed;

class CowFilterController extends Controller
{
    public function index(Request $request)
    {
        if($_GET == false)
    	   $cows = Cow::join('cattle', 'cows.cattle_id', '=', 'cattle.id')->
                orderBy('cattle.tag', 'asc');
        else
        {
            $cows = (new Cow)->newQuery()->
                join('cattle', 'cows.cattle_id', '=', 'cattle.id');

            //search by cow fertility
            if($request->has('cow_fertility'))
                $cows->where('cows.is_fertile', $request->cow_fertility);

            if($request->has('cow_pregnancy_status'))
                $cows->where('cows.pregnancy_status', $request->cow_pregnancy_status);

            //search by cattle tag
            if($request->has('cattle_tag'))
                $cows->where('cattle.tag', $request->cattle_tag);

            //search by cattle breed
            if($request->has('cattle_breed'))
                $cows->where('cattle.breed_id', $request->cattle_breed);

            //search by cattle is_alive
            if($request->has('cattle_is_alive'))
                $cows->where('cattle.is_alive', $request->cattle_is_alive);

            $cows->orderBy('cattle.tag', 'asc');
        }

    	return view('cow_filters.index', [
            'cows' => $cows->paginate(12),
            'breed_list' => Breed::orderBy('name', 'asc')->get()
        ]);
    }
}