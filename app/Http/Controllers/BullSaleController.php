<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUpdateBullSaleRequest;
use App\Bull;
use App\BullSale;
use App\Client;
use Carbon\Carbon;

class BullSaleController extends Controller
{
    public function index()
    {
		$is_search = isset($_GET['search']);
    	if($is_search == false)
    	{
            $bulls = Bull::paginate(12);
    	}
        else
        {
            $bulls = Bull::whereHas('cattle', function ($q) {
                $q->where('tag', 'LIKE', '%' . $_GET['search'] . '%');
            })->paginate(12);
        }

        return view('bulls_sales.index', ['bulls' => $bulls]);
    }

    public function create()
    {
        $bull_id = $_GET['bull'];
        $bull = Bull::findOrFail($bull_id);
        $client_list = Client::all();
        return view('bulls_sales.create', [
            'bull' => $bull,
            'client_list' => $client_list]);
    }

    public function store(StoreUpdateBullSaleRequest $request)
    {
        $bull_id = $_GET['bull'];
        $bull = Bull::findOrFail($bull_id);

        $sale = new BullSale;
        $sale->sale_date = Carbon::createFromFormat('d/m/Y', $request->sale_date);
        $sale->sale_weight = $request->sale_weight;
        $sale->price_per_kilo = $request->price_per_kilo;
        $sale->client_id = $request->client_id;
        $sale->save();

        $bull->sale_id = $sale->id;
        $bull->update();

        return redirect()->route('bulls_sales.index');
    }

    public function show($id)
    {
        $bull = Bull::findOrFail($id);
        $client = $bull->sale->client->first_name . ' ' . $bull->sale->client->last_name . ' (' . $bull->sale->client->company . ')';
        return view('bulls_sales.show', [
            'bull' => $bull,
            'client' => $client]);
    }

    public function edit($id)
    {
        $bull = Bull::findOrFail($id);
        $client_list = Client::all();
        return view('bulls_sales.edit', [
            'bull'=>$bull,
            'client_list' => $client_list]);
    }

    public function update(StoreUpdateBullSaleRequest $request, $id)
    {
        $bull = Bull::findOrFail($id);
        $sale = $bull->sale;
        $sale->sale_date = Carbon::createFromFormat('d/m/Y', $request->sale_date);
        $sale->sale_weight = $request->sale_weight;
        $sale->price_per_kilo = $request->price_per_kilo;
        $sale->client_id = $request->client_id;
        $sale->update();

        return redirect()->route('bulls_sales.index');
    }
}
