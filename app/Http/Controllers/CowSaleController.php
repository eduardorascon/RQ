<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUpdateCowSaleRequest;
use App\Cow;
use App\CowSale;
use App\Client;
use Carbon\Carbon;

class CowSaleController extends Controller
{
    public function index()
    {
		$is_search = isset($_GET['search']);
    	if($is_search == false)
    	{
            $cows = Cow::paginate(12);
    	}
        else
        {
            $cows = Cow::whereHas('cattle', function ($q) {
                $q->where('tag', 'LIKE', '%' . $_GET['search'] . '%');
            })->paginate(12);
        }

        return view('cows_sales.index', ['cows' => $cows]);
    }

    public function create()
    {
        $cow_id = $_GET['cow'];
        $cow = Cow::findOrFail($cow_id);
        $client_list = Client::all();
        return view('cows_sales.create', [
            'cow' => $cow,
            'client_list' => $client_list]);
    }

    public function store(StoreUpdateCowSaleRequest $request)
    {
        $cow_id = $_GET['cow'];
        $cow = Cow::findOrFail($cow_id);

        $sale = new CowSale;
        $sale->sale_date = Carbon::createFromFormat('d/m/Y', $request->sale_date);
        $sale->sale_weight = $request->sale_weight;
        $sale->price_per_kilo = $request->price_per_kilo;
        $sale->client_id = $request->client_id;
        $sale->save();

        $cow->sale_id = $sale->id;
        $cow->update();

        return redirect()->route('cows_sales.index');
    }

    public function show($id)
    {
        $cow = Cow::findOrFail($id);
        $client = $cow->sale->client->first_name . ' ' . $cow->sale->client->last_name . ' (' . $cow->sale->client->company . ')';
        return view('cows_sales.show', [
            'cow' => $cow,
            'client' => $client]);
    }

    public function edit($id)
    {
        $cow = Cow::findOrFail($id);
        $client_list = Client::all();
        return view('cows_sales.edit', [
            'cow'=>$cow,
            'client_list' => $client_list]);
    }

    public function update(StoreUpdateCowSaleRequest $request, $id)
    {
        $cow = Cow::findOrFail($id);
        $sale = $cow->sale;
        $sale->sale_date = Carbon::createFromFormat('d/m/Y', $request->sale_date);
        $sale->sale_weight = $request->sale_weight;
        $sale->price_per_kilo = $request->price_per_kilo;
        $sale->client_id = $request->client_id;
        $sale->update();

        return redirect()->route('cows_sales.index');
    }
}
