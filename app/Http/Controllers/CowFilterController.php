<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cow;
use App\Cattle;
use App\Breed;
use App\Owner;
use App\Paddock;
use Carbon\Carbon;

class CowFilterController extends Controller
{
    public function index(Request $request)
    {
        if($_GET == false)
            $cows = Cow::select('cows.*')->
                join('cattle', 'cows.cattle_id', '=', 'cattle.id')->
                orderBy('cattle.tag', 'asc');
        else
        {
            $cows = (new Cow)->newQuery()->select('cows.*')->
                join('cattle', 'cows.cattle_id', '=', 'cattle.id');

            //search by cow fertility
            if($request->has('cow_fertility'))
                $cows->where('cows.is_fertile', $request->cow_fertility);

            //search by cow pregnancy status
            if($request->has('cow_pregnancy_status'))
                $cows->where('cows.pregnancy_status', $request->cow_pregnancy_status);

            //search by number of calves
            if($request->has('cow_number_of_calves'))
                $cows->where('cows.number_of_calves', $request->cow_number_of_calves);

            //search by cattle tag
            if($request->has('cattle_tag'))
                $cows->where('cattle.tag', $request->cattle_tag)->orWhere('cattle.tag', 'like', '%' . $request->cattle_tag . '%');

            //search by cattle birth
            if($request->has('cattle_birth_since') && $request->has('cattle_birth_until'))
            {
                $birth_since = Carbon::createFromFormat('d/m/Y', $request->cattle_birth_since);
                $birth_until = Carbon::createFromFormat('d/m/Y', $request->cattle_birth_until);
                $bulls->whereBetween('cattle.birth', array($birth_since, $birth_until));
            }

            //search by cattle purchase date
            if($request->has('cattle_purchase_date_since') && $request->has('cattle_purchase_date_until'))
            {
                $purchase_since = Carbon::createFromFormat('d/m/Y', $request->cattle_purchase_date_since);
                $purchase_until = Carbon::createFromFormat('d/m/Y', $request->cattle_purchase_date_until);
                $bulls->whereBetween('cattle.purchase_date', array($purchase_since, $purchase_until));
            }

            //search by cattle breed
            if($request->has('cattle_breed'))
                $cows->where('cattle.breed_id', $request->cattle_breed);

            //search by cattle owner
            if($request->has('cattle_owner'))
                $cows->where('cattle.owner_id', $request->cattle_owner);

            //search by cattle paddock
            if($request->has('cattle_paddock'))
                $cows->where('cattle.paddock_id', $request->cattle_paddock);

            //search by cattle is_alive
            if($request->has('cattle_is_alive'))
                $cows->where('cattle.is_alive', $request->cattle_is_alive);

            //search by sold status
            if($request->has('cow_currently_sold')){
                if($request->cow_currently_sold == 'Si')
                    $cows->whereNotNull('sale_id');
                else
                    $cows->whereNull('sale_id');
            }

            $cows->orderBy('cattle.tag', 'asc');
        }

        $cattle = Cow::select('cattle.*')->
            join('cattle', 'cows.cattle_id', '=', 'cattle.id');

    	return view('cow_filters.index', [
            'cows' => $cows->paginate(12),
            'breed_list' => Breed::orderBy('name', 'asc')->get(),
            'owner_list' => Owner::orderBy('name', 'asc')->get(),
            'paddock_list' => Paddock::orderBy('name', 'asc')->get()
        ]);
    }
}