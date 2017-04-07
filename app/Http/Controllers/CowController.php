<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cow;
use App\Cattle;
use App\Breed;
use App\WeightLog;
use App\Vaccine;
use App\VaccineLog;
use App\PalpationLog;
use App\Picture;
use Carbon\Carbon;

class CowController extends Controller
{
    public function index()
    {
        $cows = Cow::paginate(12);
        $total_cows = Cow::count();
        return view('cows.index', [
            'cows' => $cows,
            'total_cows' => $total_cows]);
    }

    public function create()
    {
        $breed_list = Breed::orderBy('name', 'asc')->get();
        return view('cows.create', ['breed_list'=>$breed_list]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
              'cattle_tag'=> 'required',
              'cattle_birth_date' => 'required',
              'cattle_purchase_date' => 'required',
              'cattle_breed' => 'required']);

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
        $vaccine_list = Vaccine::orderBy('name', 'asc')->get();
        return view('cows.show', [
            'cow'=>$cow,
            'breed'=>$cow->cattle->breed->name,
            'vaccine_list'=>$vaccine_list,
            'weight_logs'=>$cow->cattle->weightLog->sortBy("date"),
            'vaccine_logs'=>$cow->cattle->vaccinationLog->sortBy("date"),
            'offspring'=>$cow->offspring,
            'palpations'=>$cow->palpationLog,
            'pictures'=>$cow->cattle->pictures->sortBy('filename')]);
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
        $this->validate($request, [
              'cattle_tag'=> 'required',
              'cattle_birth_date' => 'required',
              'cattle_purchase_date' => 'required',
              'cattle_breed' => 'required']);

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
        $this->validate($request, [
              'weight'=> 'required',
              'date' => 'required',
              'comment' => 'required']);

        $cow = Cow::findOrFail($id);
        $log = new WeightLog;
        $log->weight = $request->weight;
        $log->date = $request->date;
        $log->comment = $request->comment;
        $log->cattle_id = $cow->cattle_id;
        $log->save();

        return redirect()->route('cows.show', $cow->id);
    }

    public function log_vaccine(Request $request, $id)
    {
        $this->validate($request, [
              'date'=> 'required',
              'comment' => 'required',
              'vaccine' => 'required']);

        $cow = Cow::findOrFail($id);
        $log = new VaccineLog;
        $log->date = $request->date;
        $log->comment = $request->comment;
        $log->cattle_id = $cow->cattle_id;
        $log->vaccine_id = $request->vaccine;
        $log->save();

        return redirect()->route('cows.show', $cow->id);
    }

    public function log_palpation(Request $request, $id)
    {
        $this->validate($request, [
              'date'=> 'required',
              'comment' => 'required',
              'months' => 'required']);

        $log = new PalpationLog;
        $log->months = $request->months;
        $log->date = $request->date;
        $log->comment = $request->comment;
        $log->cow_id = $id;
        $log->save();

        return redirect()->route('cows.show', $id);
    }

    public function save_picture(Request $request, $id)
    {
        $this->validate($request, ['comment'=> 'required']);

        $cow = Cow::findOrFail($id);

        if($request->hasFile('picture')) {
            $imageName = $cow->cattle_id . '-' . Carbon::now()->timestamp . '.' . $request->file('picture')->getClientOriginalExtension();
            $request->file('picture')->move(base_path() . '/public/images/', $imageName);

            $pic = new Picture;
            $pic->filename = $imageName;
            $pic->comment = $request->comment;
            $pic->cattle_id = $cow->cattle_id;
            $pic->save();
        }

        return redirect()->route('cows.show', $cow->id);
    }
}
