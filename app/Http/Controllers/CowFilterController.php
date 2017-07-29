<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CowView;
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
            $cows = CowView::select('cows_view.*')->orderBy('cows_view.tag', 'asc');
        else
        {
            $cows = (new CowView)->newQuery()->select('cows_view.*');

            //search by cow fertility
            if($request->has('cow_fertility'))
                $cows->where('cows_view.is_fertile', $request->cow_fertility);

            //search by cow pregnancy status
            if($request->has('cow_pregnancy_status'))
                $cows->where('cows_view.pregnancy_status', $request->cow_pregnancy_status);

            //search by number of calves
            if($request->has('cow_number_of_calves'))
                $cows->where('cows_view.number_of_calves', $request->cow_number_of_calves);

            //search by cattle tag
            if($request->has('cattle_tag'))
                $cows->where('cows_view.tag', $request->cattle_tag)->orWhere('cows_view.tag', 'like', '%' . $request->cattle_tag . '%');

            //search by cattle birth
            if($request->has('cattle_birth_since') && $request->has('cattle_birth_until'))
            {
                $birth_since = Carbon::createFromFormat('d/m/Y', $request->cattle_birth_since);
                $birth_until = Carbon::createFromFormat('d/m/Y', $request->cattle_birth_until);
                $cows->whereBetween('cows_view.birth', array($birth_since, $birth_until));
            }

            //search by cattle purchase date
            if($request->has('cattle_purchase_date_since') && $request->has('cattle_purchase_date_until'))
            {
                $purchase_since = Carbon::createFromFormat('d/m/Y', $request->cattle_purchase_date_since);
                $purchase_until = Carbon::createFromFormat('d/m/Y', $request->cattle_purchase_date_until);
                $cows->whereBetween('cows_view.purchase_date', array($purchase_since, $purchase_until));
            }

            //search by cattle sale date
            if($request->has('cow_sale_date_since') && $request->has('cow_sale_date_until'))
            {
                $sold_since = Carbon::createFromFormat('d/m/Y', $request->cow_sale_date_since);
                $sold_until = Carbon::createFromFormat('d/m/Y', $request->cow_sale_date_until);
                $cows->whereBetween('cows_view.sale_date', array($sold_since, $sold_until));
            }

            //search by cattle breed
            if($request->has('cattle_breed'))
                $cows->where('cows_view.breed_id', $request->cattle_breed);

            //search by cattle owner
            if($request->has('cattle_owner'))
                $cows->where('cows_view.owner_id', $request->cattle_owner);

            //search by cattle paddock
            if($request->has('cattle_paddock'))
                $cows->where('cows_view.paddock_id', $request->cattle_paddock);

            //search by cattle is_alive
            if($request->has('cattle_is_alive'))
                $cows->where('cows_view.is_alive', $request->cattle_is_alive);

            //search by sold status
            if($request->has('cow_currently_sold'))
            {
                if($request->cow_currently_sold == 'Si')
                    $cows->whereNotNull('sale_id');
                else
                    $cows->whereNull('sale_id');
            }

            //search by age
            if($request->has('cow_age_in_months'))
            {
                if($request->cow_age_in_months > 0)
                    $cows->where('age_in_months', '=' ,$request->cow_age_in_months);
            }

            $cows->orderBy('cows_view.tag', 'asc');
        }

    	return view('cow_filters.index', [
            'cows' => $cows->paginate(9),
            'breed_list' => Breed::orderBy('name', 'asc')->get(),
            'owner_list' => Owner::orderBy('name', 'asc')->get(),
            'paddock_list' => Paddock::orderBy('name', 'asc')->get()
        ]);
    }
}