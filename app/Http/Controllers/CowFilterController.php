<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CowView;
use App\Cattle;
use App\Breed;
use App\Owner;
use App\Paddock;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class CowFilterController extends Controller
{
    private $ALL_COLUMNS;
    private $EXPORT_COLUMNS;
    private $columns;

    public function __construct()
    {
        $this->ALL_COLUMNS = ['cows_view.*'];
        $this->EXPORT_COLUMNS = ['tag as ETIQUETA SINIGA', 'breed_name as RAZA', 'owner_name as DUEÑO', 'paddock_name as POTRERO',
        'is_fertile as FERTIL', 'pregnancy_status as ESTADO DE GESTACION', 'is_alive as VIVA', 'current_weight as PESO ACTUAL',
        'number_of_calves as NUMERO DE BECERROS', 'months_since_last_birth as MESES DESDE ULTIMO NACIMIENTO', 'age_in_months as EDAD EN MESES',
        'birth_with_format as FECHA DE NACIMIENTO', 'purchase_date_with_format as FECHA DE COMPRA', 'sale_date_with_format as FECHA DE VENTA'];

        $this->columns = $this->ALL_COLUMNS;
    }

    public function export(Request $request)
    {
        $this->columns = $this->EXPORT_COLUMNS;
        $cows = $this->get_data($request);

        Excel::create('Filtro de Vacas', function($excel) use($cows) {
            $excel->sheet('Listado', function($sheet) use($cows) {
                $sheet->fromArray($cows->get());
            });
        })->export('xlsx');
    }

    public function index(Request $request)
    {
        $this->columns = $this->ALL_COLUMNS;
        $cows = $this->get_data($request);

        return view('cow_filters.index', [
            'cows' => $cows->sortable()->paginate(9),
            'breed_list' => Breed::orderBy('name', 'asc')->get(),
            'owner_list' => Owner::orderBy('name', 'asc')->get(),
            'paddock_list' => Paddock::orderBy('name', 'asc')->get(),
            'qs' => $_GET
        ]);
    }

    public function get_data(Request $request)
    {
        if($_GET == false)
            $cows = CowView::select($this->columns)->orderBy('cows_view.tag', 'asc');
        else
        {
            $cows = (new CowView)->newQuery()->select($this->columns);

            //search by cattle tag
            if($request->has('cattle_tag'))
                $cows->where('cows_view.tag', '=', $request->cattle_tag)->orWhere('cows_view.tag', 'like', '%' . $request->cattle_tag . '%');

            //search by cattle birth
            if($request->has('cattle_birth_since') && $request->has('cattle_birth_until'))
            {
                $birth_since = Carbon::createFromFormat('d/m/Y', $request->cattle_birth_since);
                $birth_until = Carbon::createFromFormat('d/m/Y', $request->cattle_birth_until);
                $cows->whereBetween('cows_view.birth', array($birth_since, $birth_until))->
                    orWhereBetween('cows_view.birth', array($birth_until, $birth_since));
            }

            //search by cattle purchase date
            if($request->has('cattle_purchase_date_since') && $request->has('cattle_purchase_date_until'))
            {
                $purchase_since = Carbon::createFromFormat('d/m/Y', $request->cattle_purchase_date_since);
                $purchase_until = Carbon::createFromFormat('d/m/Y', $request->cattle_purchase_date_until);
                $cows->whereBetween('cows_view.purchase_date', array($purchase_since, $purchase_until))->
                    orWhereBetween('cows_view.purchase_date', array($purchase_until, $purchase_since));
            }

            //search by cattle sale date
            if($request->has('cow_sale_date_since') && $request->has('cow_sale_date_until'))
            {
                $sold_since = Carbon::createFromFormat('d/m/Y', $request->cow_sale_date_since);
                $sold_until = Carbon::createFromFormat('d/m/Y', $request->cow_sale_date_until);
                $cows->whereBetween('cows_view.sale_date', array($sold_since, $sold_until))->
                    orWhereBetween('cows_view.sale_date', array($sold_until, $sold_since));
            }

            //search by cattle weight
            if($request->has('cow_weight_from') && $request->has('cow_weight_to'))
            {
                $weight_from = $request->cow_weight_from;
                $weight_to = $request->cow_weight_to;
                $cows->whereBetween('cows_view.current_weight', array($weight_from, $weight_to))->
                    orWhereBetween('cows_view.current_weight', array($weight_to, $weight_from));
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

            //search by cow fertility
            if($request->has('cow_fertility'))
                $cows->where('cows_view.is_fertile', $request->cow_fertility);

            //search by cow pregnancy status
            if($request->has('cow_pregnancy_status'))
                $cows->where('cows_view.pregnancy_status', $request->cow_pregnancy_status);

            //search by number of calves
            if($request->has('cow_number_of_calves'))
                $cows->where('cows_view.number_of_calves', $request->cow_number_of_calves);

        }

    	return $cows;
    }
}