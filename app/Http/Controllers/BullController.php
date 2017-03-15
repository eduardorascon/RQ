<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bull;
use App\Cattle;
use App\Breed;
use App\WeightLog;

class BullController extends Controller
{
    public function index()
    {
        $bulls = Bull::all();
        return view('bulls.index', ['bulls' => $bulls]);
    }

    public function create()
    {
        $breed_list = Breed::orderBy('name', 'asc')->get();
        return view('bulls.create', ['breed_list'=>$breed_list]);
    }

    public function store(Request $request)
    {
        $cattle = new Cattle;
        $cattle->tag = $request->cattle_tag;
        $cattle->birth = $request->cattle_birth_date;
        $cattle->purchase_date = $request->cattle_purchase_date;
        $cattle->breed_id = $request->cattle_breed;
        $cattle->save();

        $bull = new Bull;
        $bull->cattle_id = $cattle->id;
        $bull->save();

        return redirect()->route('bulls.index');
    }

    public function show($id)
    {
        $bull = Bull::findOrFail($id);
        return view('bulls.show', [
            'bull'=>$bull,
            'breed'=>$bull->cattle->breed->name,
            'weight_logs'=>$bull->cattle->weightLog->sortBy("weight")]);
    }

    public function edit($id)
    {
        $bull = Bull::findOrFail($id);
        $breed_list = Breed::orderBy('name', 'asc')->get();
        return view('bulls.edit', [
            'bull'=>$bull,
            'breed_list'=>$breed_list]);
    }

    public function update(Request $request, $id)
    {
        $bull = Bull::findOrFail($id);
        $cattle = $bull->cattle;
        $cattle->tag = $request->cattle_tag;
        $cattle->birth = $request->cattle_birth_date;
        $cattle->purchase_date = $request->cattle_purchase_date;
        $cattle->breed_id = $request->cattle_breed;
        $cattle->update();

        return redirect()->route('bulls.index');
    }

    public function destroy($id)
    {
        $bull = Bull::findOrFail($id);
        $bull->delete();
        return redirect()->route('bulls.index');
    }

    public function log_weight(Request $request, $id)
    {
        $bull = Bull::findOrFail($id);
        $log = new WeightLog;
        $log->weight = $request->weight;
        $log->weight_date = $request->weight_date;
        $log->cattle_id = $bull->cattle_id;
        $log->save();

        return redirect()->route('bulls.show', $bull->id);
    }
}
