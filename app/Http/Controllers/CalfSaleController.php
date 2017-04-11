<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUpdateCalfSaleRequest;
use App\Calf;
use App\CalfSale;
use App\Client;

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

    public function create(StoreUpdateCalfSaleRequest $request)
    {
        $calf_id = $_GET['calf'];
        $calf = Calf::findOrFail($calf_id);
        $client_list = Client::all();
        return view('calves_sales.create', [
            'calf' => $calf,
            'client_list' => $client_list]);
    }

    public function store(Request $request)
    {
        $calf_id = $_GET['calf'];
        $calf = Calf::findOrFail($calf_id);

        $sale = new CalfSale;
        $sale->sale_date = $request->sale_date;
        $sale->sale_weight = $request->sale_weight;
        $sale->price_per_kilo = $request->price_per_kilo;
        $sale->client_id = $request->client_id;
        $sale->save();

        $calf->sale_id = $sale->id;
        $calf->update();

        return redirect()->route('calves_sales.index');
    }

    public function show($id)
    {
        $calf = Calf::findOrFail($id);
        $client = $calf->sale->client->first_name . ' ' . $calf->sale->client->last_name . ' (' . $calf->sale->client->company . ')';
        return view('calves_sales.show', [
            'calf' => $calf,
            'client' => $client]);
    }

    public function edit($id)
    {
        $calf = Calf::findOrFail($id);
        $client_list = Client::all();
        return view('calves_sales.edit', [
            'calf'=>$calf,
            'client_list' => $client_list]);
    }

    public function update(StoreUpdateCalfSaleRequest $request, $id)
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
