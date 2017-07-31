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
    private $TODOS;
    private $FILTRO;
    private $columns;

    public function __construct()
    {
        $this->TODOS = ['bulls_view.*'];
        $this->FILTRO = ['tag as ETIQUETA SINIGA', 'breed_name as RAZA', 'owner_name as DUEÑO', 'paddock_name as POTRERO',
        'is_alive as ¿ESTA VIVO?', 'gender as SEXO', 'current_weight as PESO ACTUAL', 'age_in_months as EDAD EN MESES',
        'birth_with_format as FECHA DE NACIMIENTO', 'purchase_date_with_format as FECHA DE COMPRA', 'sale_date_with_format as FECHA DE VENTA'];

        $this->columns = $this->TODOS;
    }

    public function export(Request $request)
    {
        $this->columns = $this->FILTRO;
        $bulls = $this->get_data($request);
        //dd($bulls);

        Excel::create('Filtro de Toros', function($excel) use($bulls) {
            $excel->sheet('Listado', function($sheet) use($bulls) {
                $sheet->fromModel($bulls->get());
            });
        })->export('xlsx');
    }

    public function index(Request $request)
    {
        $this->columns = $this->TODOS;
        $bulls = $this->get_data($request);
        //dd($bulls);

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
            $bulls = BullView::select($this->columns)->orderBy('bulls_view.tag', 'asc');
        else
        {
            $bulls = (new BullView)->newQuery()->select($this->columns);

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

            //search by age
            if($request->has('bull_age_in_months'))
            {
                if($request->bull_age_in_months > 0)
                    $bulls->where('age_in_months', '=' ,$request->bull_age_in_months);
            }

            $bulls->orderBy('bulls_view.tag', 'asc');
        }

        return $bulls;
    }
}
