<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BullView;
use App\Cattle;
use App\Breed;
use App\Owner;
use App\Paddock;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class BullFilterController extends Controller
{

    public function export(Request $request)
    {
        Excel::create('Filtro', function($excel) use($request) {
            $excel->sheet('Toros', function($sheet) use($request) {
                $bulls = $this->get_data($request);
                $sheet->fromArray($bulls->get());
            });
        })->export('xlsx');
    }

    public function index(Request $request)
    {
        $bulls = $this->get_data($request);

    	return view('bull_filters.index', [
    		'bulls' => $bulls->paginate(9),
    		'breed_list' => Breed::orderBy('name', 'asc')->get(),
            'owner_list' => Owner::orderBy('name', 'asc')->get(),
            'paddock_list' => Paddock::orderBy('name', 'asc')->get(),
            'qs' => $_GET
    	]);
    }

    private function get_data(Request $request)
    {
        if($_GET == false)
            $bulls = BullView::select('bulls_view.*')->orderBy('bulls_view.tag', 'asc');
        else
        {
            $bulls = (new BullView)->newQuery()->select('bulls_view.*');

            //search by cattle tag
            if($request->has('cattle_tag'))
                $bulls->where('bulls_view.tag', $request->cattle_tag)->orWhere('bulls_view.tag', 'like', '%' . $request->cattle_tag . '%');

            //search by cattle birth
            if($request->has('cattle_birth_since') && $request->has('cattle_birth_until'))
            {
                $birth_since = Carbon::createFromFormat('d/m/Y', $request->cattle_birth_since);
                $birth_until = Carbon::createFromFormat('d/m/Y', $request->cattle_birth_until);
                $bulls->whereBetween('bulls_view.birth', array($birth_since, $birth_until));
            }

            //search by cattle purchase date
            if($request->has('cattle_purchase_date_since') && $request->has('cattle_purchase_date_until'))
            {
                $purchase_since = Carbon::createFromFormat('d/m/Y', $request->cattle_purchase_date_since);
                $purchase_until = Carbon::createFromFormat('d/m/Y', $request->cattle_purchase_date_until);
                $bulls->whereBetween('bulls_view.purchase_date', array($purchase_since, $purchase_until));
            }

            //search by cattle sale date
            if($request->has('bull_sale_date_since') && $request->has('bull_sale_date_until'))
            {
                $sold_since = Carbon::createFromFormat('d/m/Y', $request->bull_sale_date_since);
                $sold_until = Carbon::createFromFormat('d/m/Y', $request->bull_sale_date_until);
                $bulls->whereBetween('bulls_view.sale_date', array($sold_since, $sold_until));
            }

            //search by cattle breed
            if($request->has('cattle_breed'))
                $bulls->where('bulls_view.breed_id', $request->cattle_breed);

            //search by cattle owner
            if($request->has('cattle_owner'))
                $bulls->where('bulls_view.owner_id', $request->cattle_owner);

            //search by cattle paddock
            if($request->has('cattle_paddock'))
                $bulls->where('bulls_view.paddock_id', $request->cattle_paddock);

            //search by cattle is_alive
            if($request->has('cattle_is_alive'))
                $bulls->where('bulls_view.is_alive', $request->cattle_is_alive);

            //search by sold status
            if($request->has('bull_currently_sold'))
            {
                if($request->bull_currently_sold == 'Si')
                    $bulls->whereNotNull('sale_id');
                else
                    $bulls->whereNull('sale_id');
            }

            $bulls->orderBy('bulls_view.tag', 'asc');
        }

        return $bulls;
    }
}
