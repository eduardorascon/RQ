<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cow;
use App\Cattle;

class CowFilterController extends Controller
{
    public function index(Request $request)
    {

        if($_GET == false)
    	   $cows = Cow::getAll();
        else
        {
            $cows = (new Cow)->newQuery();

            //search by cattle tag
            if($request->has('cattle_tag'))
            {
                $cows->join('cattle', 'cows.cattle_id', '=', 'cattle.id')->
                    where('cattle.tag', $request->cattle_tag);
            }
        }

    	return view('cow_filters.index', ['cows' => $cows->paginate(12)]);
    }

    public function search(Request $request)
    {
    	$cows = (new Cow)->newQuery();

    	//search by cattle tag
    	if($request->has('cattle_tag'))
    	{
    		$cows->
                join('cattle', 'cows.cattle_id', '=', 'cattle.id')->
                where('cattle.tag', $request->cattle_tag);
    	}

        return redirect()->route('cow_filters.index', ['cows' => $cows->get()]);
    }
}