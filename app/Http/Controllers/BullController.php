<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUpdateCattleRequest;
use App\Http\Requests\StoreUpdateLogWeightRequest;
use App\Http\Requests\StoreUpdateLogVaccineRequest;
use App\Http\Requests\StorePictureRequest;
use App\Bull;
use App\Cattle;
use App\Breed;
use App\Owner;
use App\Paddock;
use App\WeightLog;
use App\Vaccine;
use App\VaccineLog;
use App\Picture;
use Carbon\Carbon;
use Khill\Lavacharts\Lavacharts;

class BullController extends Controller
{
    public function index()
    {
        $bulls = Bull::paginate(12);
        $total_bulls = Bull::count();
        return view('bulls.index', [
            'bulls' => $bulls,
            'total_bulls' => $total_bulls
        ]);
    }

    public function create()
    {
        $breed_list = Breed::orderBy('name', 'asc')->get();
        $owner_list = Owner::orderBy('name', 'asc')->get();
        $paddock_list = Paddock::orderBy('name', 'asc')->get();
        return view('bulls.create', [
            'breed_list' => $breed_list,
            'owner_list' => $owner_list,
            'paddock_list' => $paddock_list
        ]);
    }

    public function store(StoreUpdateCattleRequest $request)
    {
        $cattle = new Cattle;
        $cattle->tag = $request->cattle_tag;
        $cattle->birth = $request->cattle_birth_date;
        $cattle->purchase_date = $request->cattle_purchase_date;
        $cattle->breed_id = $request->cattle_breed;
        $cattle->owner_id = $request->cattle_owner;
        $cattle->paddock_id = $request->cattle_paddock;
        $cattle->gender = 'Macho';
        $cattle->is_alive = $request->cattle_is_alive;
        $cattle->save();

        $bull = new Bull;
        $bull->cattle_id = $cattle->id;
        $bull->save();

        return redirect()->route('bulls.index');
    }

    public function show($id)
    {
        $bull = Bull::findOrFail($id);
        $vaccine_list = Vaccine::orderBy('name', 'asc')->get();
        $this->weight_chart($bull->cattle);
        return view('bulls.show', [
            'bull' => $bull,
            'breed' => $bull->cattle->breed->name,
            'owner' => $bull->cattle->owner === NULL ? '' : $bull->cattle->owner->name,
            'paddock' => $bull->cattle->paddock === NULL ? '' : $bull->cattle->paddock->name,
            'vaccine_list' => $vaccine_list,
            'weight_logs' => $bull->cattle->weightLog->sortBy("date"),
            'vaccine_logs' => $bull->cattle->vaccinationLog->sortBy("date"),
            'pictures' => $bull->cattle->pictures->sortBy('filename')
        ]);
    }

    public function edit($id)
    {
        $bull = Bull::findOrFail($id);
        $breed_list = Breed::orderBy('name', 'asc')->get();
        $owner_list = Owner::orderBy('name', 'asc')->get();
        $paddock_list = Paddock::orderBy('name', 'asc')->get();
        return view('bulls.edit', [
            'bull' => $bull,
            'breed_list' => $breed_list,
            'owner_list' => $owner_list,
            'paddock_list' => $paddock_list
        ]);
    }

    public function update(StoreUpdateCattleRequest $request, $id)
    {
        $bull = Bull::findOrFail($id);
        $cattle = $bull->cattle;
        $cattle->tag = $request->cattle_tag;
        $cattle->birth = $request->cattle_birth_date;
        $cattle->purchase_date = $request->cattle_purchase_date;
        $cattle->breed_id = $request->cattle_breed;
        $cattle->owner_id = $request->cattle_owner;
        $cattle->paddock_id = $request->cattle_paddock;
        $cattle->is_alive = $request->cattle_is_alive;
        $cattle->update();

        return redirect()->route('bulls.index');
    }

    public function destroy($id)
    {
        $bull = Bull::findOrFail($id);
        $bull->delete();
        return redirect()->route('bulls.index');
    }

    public function log_weight(StoreUpdateLogWeightRequest $request, $id)
    {
        $bull = Bull::findOrFail($id);
        $log = new WeightLog;
        $log->weight = $request->weight;
        $log->date = $request->date;
        $log->comment = $request->comment;
        $log->cattle_id = $bull->cattle_id;
        $log->save();

        return redirect()->route('bulls.show', $bull->id);
    }

    public function log_vaccine(StoreUpdateLogVaccineRequest $request, $id)
    {
        $bull = Bull::findOrFail($id);
        $log = new VaccineLog;
        $log->date = $request->date;
        $log->comment = $request->comment;
        $log->cattle_id = $bull->cattle_id;
        $log->vaccine_id = $request->vaccine;
        $log->save();

        return redirect()->route('bulls.show', $bull->id);
    }

    public function save_picture(StorePictureRequest $request, $id)
    {
        $bull = Bull::findOrFail($id);

        if($request->hasFile('picture')) {
            $imageName = $bull->cattle_id . '-' . Carbon::now()->timestamp . '.' . $request->file('picture')->getClientOriginalExtension();
            $request->file('picture')->move(base_path() . '/public/images/', $imageName);

            $pic = new Picture;
            $pic->filename = $imageName;
            $pic->comment = $request->comment;
            $pic->cattle_id = $bull->cattle_id;
            $pic->save();
        }

        return redirect()->route('bulls.show', $bull->id);
    }

    public function weight_chart(Cattle $cattle)
    {
        $stocksTable = \Lava::DataTable();

        $stocksTable->addDateColumn('Fecha de pesaje')
                    ->addNumberColumn('Peso');

        $weight_logs = $cattle->weightLog->sortBy("date");
        foreach($weight_logs as $log)
        {
            $stocksTable->addRow([
                $log->date, $log->weight
            ]);
        }

        $chart = \Lava::LineChart('MyStocks', $stocksTable);
    }
}
