<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CalfView;
use App\Cattle;
use App\Breed;
use App\Owner;
use App\Paddock;
use App\Cow;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class CalfFilterController extends Controller
{
    private $ALL_COLUMNS;
    private $EXPORT_COLUMNS;
    private $columns;

    public function __construct()
    {
        $this->ALL_COLUMNS = ['calves_view.*'];
        $this->EXPORT_COLUMNS = ['tag as ETIQUETA SINIGA', 'breed_name as RAZA', 'owner_name as DUEÑO', 'paddock_name as POTRERO',
        'is_alive as ¿ESTA VIVO?', 'gender as SEXO', 'current_weight as PESO ACTUAL', 'age_in_months as EDAD EN MESES',
        'birth_with_format as FECHA DE NACIMIENTO', 'purchase_date_with_format as FECHA DE COMPRA', 'sale_date_with_format as FECHA DE VENTA'];

        $this->columns = $this->ALL_COLUMNS;
    }

    public function export(Request $request)
    {
        $this->columns = $this->EXPORT_COLUMNS;
        $calves = $this->get_data($request);

        Excel::create('Filtro de Becerros', function($excel) use($calves) {
            $excel->sheet('Listado', function($sheet) use($calves) {
                $sheet->fromArray($calves->get());
            });
        })->export('xlsx');
    }

    public function index(Request $request)
    {
        $this->columns = $this->ALL_COLUMNS;
        $calves = $this->get_data($request);

        $cow_list = Cow::select('calves.cow_id', 'cattle.tag')->join('calves', 'cows.id', '=', 'calves.cow_id')
            ->join('cattle', 'cows.cattle_id', '=', 'cattle.id')->orderBy('cattle.tag', 'asc')->get();

        return view('calf_filters.index', [
            'calves' => $calves->paginate(9),
            'cow_list' => $cow_list,
            'breed_list' => Breed::orderBy('name', 'asc')->get(),
            'owner_list' => Owner::orderBy('name', 'asc')->get(),
            'paddock_list' => Paddock::orderBy('name', 'asc')->get(),
            'qs' => $_GET
        ]);
    }

    public function get_data(Request $request)
    {
    	if($_GET == false)
    		$calves = CalfView::select($this->columns)->orderBy('calves_view.tag', 'asc');
    	else
    	{
    		$calves = (new CalfView)->newQuery()->select($this->columns);

            //search by calf mother
            if($request->has('cow_id'))
                $calves->where('calves_view.mother_id', $request->cow_id);

            //search by cattle tag
            if($request->has('cattle_tag'))
                $calves->where('calves_view.tag', $request->cattle_tag)->orWhere('calves_view.tag', 'like', '%' . $request->cattle_tag . '%');

            //search by cattle birth
            if($request->has('cattle_birth_since') && $request->has('cattle_birth_until'))
            {
                $birth_since = Carbon::createFromFormat('d/m/Y', $request->cattle_birth_since);
                $birth_until = Carbon::createFromFormat('d/m/Y', $request->cattle_birth_until);
                $calves->whereBetween('calves_view.birth', array($birth_since, $birth_until));
            }

            //search by cattle purchase date
            if($request->has('cattle_purchase_date_since') && $request->has('cattle_purchase_date_until'))
            {
                $purchase_since = Carbon::createFromFormat('d/m/Y', $request->cattle_purchase_date_since);
                $purchase_until = Carbon::createFromFormat('d/m/Y', $request->cattle_purchase_date_until);
                $calves->whereBetween('calves_view.purchase_date', array($purchase_since, $purchase_until));
            }

            //search by cattle sale date
            if($request->has('calf_sale_date_since') && $request->has('calf_sale_date_until'))
            {
                $sold_since = Carbon::createFromFormat('d/m/Y', $request->calf_sale_date_since);
                $sold_until = Carbon::createFromFormat('d/m/Y', $request->calf_sale_date_until);
                $calves->whereBetween('calves_view.sale_date', array($sold_since, $sold_until));
            }

            //search by cattle breed
            if($request->has('cattle_breed'))
                $calves->where('calves_view.breed_id', $request->cattle_breed);

            //search by cattle owner
            if($request->has('cattle_owner'))
                $calves->where('calves_view.owner_id', $request->cattle_owner);

            //search by cattle paddock
            if($request->has('cattle_paddock'))
                $calves->where('calves_view.paddock_id', $request->cattle_paddock);

            //search by cattle is_alive
            if($request->has('cattle_is_alive'))
                $calves->where('calves_view.is_alive', $request->cattle_is_alive);

            //search by sold status
            if($request->has('calf_currently_sold'))
            {
                if($request->calf_currently_sold == 'Si')
                    $calves->whereNotNull('sale_id');
                else
                    $calves->whereNull('sale_id');
            }

            //search by age
            if($request->has('calf_age_in_months'))
            {
                if($request->calf_age_in_months > 0)
                    $calves->where('age_in_months', '=' ,$request->calf_age_in_months);
            }

            $calves->orderBy('calves_view.tag', 'asc');
    	}

        return $calves;
    }
}
