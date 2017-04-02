<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Calf;
use App\CalfSale;

class CalfSaleController extends Controller
{
    public function index()
    {
		$is_search = isset($_GET['search']);
    	if($is_search == false)
    	{
            $calves = Calf::paginate(12);
    	}
        else{
            $calves = Calf::whereHas('cattle', function ($q) {
                $q->where('tag', 'LIKE', '%' . $_GET['search'] . '%');
            })->paginate(12);
        }

        return view('calves_sales.index', ['calves' => $calves]);
    }

    public function create(Request $request)
    {
        //$this->getQueryString()
        $calf_id = $request->getQueryString();
        $calf = Calf::findOrFail($calf_id);
        return view('calves_sales.create', ['calf'=>$calf]);
    }

    public function store(Request $request)
    {
        $calf_id = $request->getQueryString();
        $calf = Calf::findOrFail($calf_id);

        $sale = new CalfSale;
        $sale->sale_date = $request->sale_date;
        $sale->sale_weight = $request->sale_weight;
        $sale->price_per_kilo = $request->price_per_kilo;
        $sale->save();

        $calf->sale_id = $sale->id;
        $calf->update();

        return redirect()->route('calves_sales.index');
    }

    public function show($id)
    {
        $calf = Calf::findOrFail($id);
        return view('calves_sales.show', ['calf'=>$calf]);
    }

    public function edit($id)
    {
        $calf = Calf::findOrFail($id);
        return view('calves_sales.edit', [
            'calf'=>$calf]);
    }

    public function update(Request $request, $id)
    {
        $calf = Calf::findOrFail($id);

        $sale = $calf->sale;
        $sale->sale_date = $request->sale_date;
        $sale->sale_weight = $request->sale_weight;
        $sale->price_per_kilo = $request->price_per_kilo;
        $sale->update();

        return redirect()->route('calves_sales.index');
    }
}
