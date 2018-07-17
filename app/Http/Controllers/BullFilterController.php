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
    private $ALL_COLUMNS;
    private $EXPORT_COLUMNS;
    private $columns;

    public function __construct()
    {
        $this->ALL_COLUMNS = ['bulls_view.*'];
        $this->EXPORT_COLUMNS = ['tag as ETIQUETA SINIGA', 'control_tag as ARETE DE CONTROL', 'breed_name as RAZA', 'owner_name as DUEÑO', 'paddock_name as POTRERO',
        'is_alive as VIVO', 'current_weight as PESO ACTUAL', 'age_in_months as EDAD EN MESES',
        'birth_with_format as FECHA DE NACIMIENTO', 'purchase_date_with_format as FECHA DE COMPRA', 'empadre_date_with_format as FECHA DE EMPADRE', 'sale_date_with_format as FECHA DE VENTA', 'comments as COMENTARIOS'];

        $this->columns = $this->ALL_COLUMNS;
    }

    public function export(Request $request)
    {
        $this->columns = $this->EXPORT_COLUMNS;
        $bulls = $this->get_data($request);

        Excel::create('Filtro de Toros', function($excel) use($bulls) {
            $excel->sheet('Listado', function($sheet) use($bulls) {
                $sheet->setColumnFormat(array(
                    'G' => '0.00',
                    'A' => '0', 'B' => '0', 'H' => '0',
                    'I' => 'dd/mm/yyyy', 'J' => 'dd/mm/yyyy', 'K' => 'dd/mm/yyyy', 'L' => 'dd/mm/yyyy'
                ));
                $sheet->fromModel($bulls->get());
            });
        })->export('xlsx');
    }

    public function index(Request $request)
    {
        $this->columns = $this->ALL_COLUMNS;
        $bulls = $this->get_data($request);

    	return view('bull_filters.index', [
    		'bulls' => $bulls->sortable()->orderBy('id', 'asc')->paginate(9),
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
                $bulls->where('bulls_view.tag', '=', $request->cattle_tag)->orWhere('bulls_view.tag', 'like', '%' . $request->cattle_tag . '%');

            //search by control tag
            if($request->has('control_tag'))
                $bulls->where('bulls_view.control_tag', '=', $request->control_tag)->orWhere('bulls_view.control_tag', 'like', '%' . $request->control_tag . '%');

            //search by cattle birth
            if($request->has('cattle_birth_since') && $request->has('cattle_birth_until'))
            {
                $birth_since = Carbon::createFromFormat('d/m/Y', $request->cattle_birth_since);
                $birth_until = Carbon::createFromFormat('d/m/Y', $request->cattle_birth_until);
                $bulls->whereBetween('bulls_view.birth', array($birth_since, $birth_until))->
                    orWhereBetween('bulls_view.birth', array($birth_until, $birth_since));
            }

            //search by cattle purchase date
            if($request->has('cattle_purchase_date_since') && $request->has('cattle_purchase_date_until'))
            {
                $purchase_since = Carbon::createFromFormat('d/m/Y', $request->cattle_purchase_date_since);
                $purchase_until = Carbon::createFromFormat('d/m/Y', $request->cattle_purchase_date_until);
                $bulls->whereBetween('bulls_view.purchase_date', array($purchase_since, $purchase_until))->
                    orWhereBetween('bulls_view.purchase_date', array($purchase_until, $purchase_since));
            }

            //search by cattle empadre date
            if($request->has('cattle_empadre_since') && $request->has('cattle_empadre_until'))
            {
                $empadre_since = Carbon::createFromFormat('d/m/Y', $request->cattle_empadre_since);
                $empadre_until = Carbon::createFromFormat('d/m/Y', $request->cattle_empadre_until);
                $bulls->whereBetween('bulls_view.empadre_date', array($empadre_since, $empadre_until))->
                    orWhereBetween('bulls_view.empadre_date', array($empadre_until, $empadre_since));
            }

            //search by cattle sale date
            if($request->has('bull_sale_date_since') && $request->has('bull_sale_date_until'))
            {
                $sold_since = Carbon::createFromFormat('d/m/Y', $request->bull_sale_date_since);
                $sold_until = Carbon::createFromFormat('d/m/Y', $request->bull_sale_date_until);
                $bulls->whereBetween('bulls_view.sale_date', array($sold_since, $sold_until))->
                    orWhereBetween('bulls_view.sale_date', array($sold_until, $sold_since));
            }

            //search by cattle weight
            if($request->has('bull_weight_from') && $request->has('bull_weight_to'))
            {
                $weight_from = $request->bull_weight_from;
                $weight_to = $request->bull_weight_to;
                $bulls->whereBetween('bulls_view.current_weight', array($weight_from, $weight_to))->
                    orWhereBetween('bulls_view.current_weight', array($weight_to, $weight_from));
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
        }

        return $bulls;
    }
}
