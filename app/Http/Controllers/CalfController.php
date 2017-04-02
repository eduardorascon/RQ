<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Calf;
use App\Cattle;
use App\Breed;
use App\WeightLog;
use App\Vaccine;
use App\VaccineLog;
use App\Cow;

class CalfController extends Controller
{
    public function index()
    {
        $calfs = Calf::paginate(12);
        $total_calves = Calf::count();
        return view('calfs.index', [
            'calfs' => $calfs,
            'total_calves' => $total_calves]);
    }

    public function create()
    {
        $breed_list = Breed::orderBy('name', 'asc')->get();
        $cow_list = Cow::whereHas('cattle', function ($q) {
            $q->orderBy('tag', 'asc');
        })->with('cattle')->get();

        return view('calfs.create', [
            'breed_list'=>$breed_list,
            'cow_list'=>$cow_list]);
    }

    public function create_offspring($cow_id)
    {
        $breed_list = Breed::orderBy('name', 'asc')->get();
        $cow = Cow::findOrFail($cow_id);
        return view('calfs.create', [
            'breed_list'=>$breed_list,
            'cow'=>$cow]);
    }

    public function store(Request $request)
    {
        $cow_id = $request->cow_id;
        $cow = Cow::findOrFail($cow_id);

        $cattle = new Cattle;
        $cattle->tag = $request->cattle_tag;
        $cattle->birth = $request->cattle_birth_date;
        $cattle->purchase_date = $request->cattle_purchase_date;
        $cattle->breed_id = $request->cattle_breed;
        $cattle->save();

        $calf = new Calf;
        $calf->cattle_id = $cattle->id;
        $calf->cow_id = $cow->id;
        $calf->save();

        return redirect()->route('calfs.index');
    }

    public function show($id)
    {
        $calf = Calf::findOrFail($id);
        $vaccine_list = Vaccine::orderBy('name', 'asc')->get();
        return view('calfs.show', [
            'calf'=>$calf,
            'breed'=>$calf->cattle->breed->name,
            'vaccine_list'=>$vaccine_list,
            'weight_logs'=>$calf->cattle->weightLog->sortBy("date"),
            'vaccine_logs'=>$calf->cattle->vaccinationLog->sortBy("date")]);
    }

    public function edit($id)
    {
        $calf = Calf::findOrFail($id);
        $breed_list = Breed::orderBy('name', 'asc')->get();
        return view('calfs.edit', [
            'calf'=>$calf,
            'breed_list'=>$breed_list]);
    }

    public function update(Request $request, $id)
    {
        $calf = Calf::findOrFail($id);
        $cattle = $calf->cattle;
        $cattle->tag = $request->cattle_tag;
        $cattle->birth = $request->cattle_birth_date;
        $cattle->purchase_date = $request->cattle_purchase_date;
        $cattle->breed_id = $request->cattle_breed;
        $cattle->update();

        return redirect()->route('calfs.index');
    }

    public function destroy($id)
    {
        $calf = Calf::findOrFail($id);
        $calf->delete();
        return redirect()->route('calfs.index');
    }

    public function log_weight(Request $request, $id)
    {
        $calf = Calf::findOrFail($id);
        $log = new WeightLog;
        $log->weight = $request->weight;
        $log->date = $request->date;
        $log->comment = $request->comment;
        $log->cattle_id = $calf->cattle_id;
        $log->save();

        return redirect()->route('calfs.show', $calf->id);
    }

    public function log_vaccine(Request $request, $id)
    {
        $calf = Calf::findOrFail($id);
        $log = new VaccineLog;
        $log->date = $request->date;
        $log->comment = $request->comment;
        $log->cattle_id = $calf->cattle_id;
        $log->vaccine_id = $request->vaccine;
        $log->save();

        return redirect()->route('calfs.show', $calf->id);
    }
}
