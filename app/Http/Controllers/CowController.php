<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cow;
use App\Cattle;
use App\Breed;
use App\WeightLog;

class CowController extends Controller
{
    public function index()
    {
        $cows = Cow::all();
        return view('cows.index', ['cows' => $cows]);
    }

    public function create()
    {
        $breed_list = Breed::orderBy('name', 'asc')->get();
        return view('cows.create', ['breed_list'=>$breed_list]);
    }

    public function store(Request $request)
    {
        $cattle = new Cattle;
        $cattle->tag = $request->cattle_tag;
        $cattle->birth = $request->cattle_birth_date;
        $cattle->purchase_date = $request->cattle_purchase_date;
        $cattle->breed_id = $request->cattle_breed;
        $cattle->save();

        $cow = new Cow;
        $cow->cattle_id = $cattle->id;
        $cow->save();

        return redirect()->route('cows.index');
    }

    public function show($id)
    {
        $cow = Cow::findOrFail($id);
        return view('cows.show', [
            'cow'=>$cow,
            'breed'=>$cow->cattle->breed->name,
            'weight_logs'=>$cow->cattle->weightLog->sortBy("weight")]);
    }

    public function edit($id)
    {
        $cow = Cow::findOrFail($id);
        $breed_list = Breed::orderBy('name', 'asc')->get();
        return view('cows.edit', [
            'cow'=>$cow,
            'breed_list'=>$breed_list]);
    }

    public function update(Request $request, $id)
    {
        $cow = Cow::findOrFail($id);
        $cattle = $cow->cattle;
        $cattle->tag = $request->cattle_tag;
        $cattle->birth = $request->cattle_birth_date;
        $cattle->purchase_date = $request->cattle_purchase_date;
        $cattle->breed_id = $request->cattle_breed;
        $cattle->update();

        return redirect()->route('cows.index');
    }

    public function destroy($id)
    {
        $cow = Cow::findOrFail($id);
        $cow->delete();
        return redirect()->route('cows.index');
    }

    public function log_weight(Request $request, $id)
    {
        $cow = Cow::findOrFail($id);
        $log = new WeightLog;
        $log->weight = $request->weight;
        $log->date = $request->date;
        $log->comment = $request->comment;
        $log->cattle_id = $cow->cattle_id;
        $log->save();

        return redirect()->route('cows.show', $cow->id);
    }
}
