<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreBullRequest;
use App\Http\Requests\UpdateBullRequest;
use App\Http\Requests\StoreUpdateLogWeightRequest;
use App\Http\Requests\StoreUpdateLogVaccineRequest;
use App\Http\Requests\StorePictureRequest;
use App\Bull;
use App\BullView;
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
use DB;

class BullController extends Controller
{
    public function index()
    {
        $bulls = BullView::sortable()->orderBy('id', 'asc')->paginate(9);
        $total_bulls = BullView::count();

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

    public function store(StoreBullRequest $request)
    {
        DB::transaction(function() use ($request) {
            $cattle = new Cattle;
            $cattle->tag = $request->cattle_tag;
            $cattle->birth = Carbon::createFromFormat('d/m/Y', $request->cattle_birth_date);
            $cattle->purchase_date = $request->cattle_purchase_date === NULL ? NULL : Carbon::createFromFormat('d/m/Y', $request->cattle_purchase_date);
            $cattle->breed_id = $request->cattle_breed;
            $cattle->owner_id = $request->cattle_owner;
            $cattle->paddock_id = $request->cattle_paddock;
            $cattle->gender = 'Macho';
            $cattle->is_alive = $request->cattle_is_alive;
            $cattle->control_tag = $request->control_tag;
            if($request->empadre_date != NULL)
                $cattle->empadre_date = Carbon::createFromFormat('d/m/Y', $request->empadre_date);
            $cattle->save();

            $bull = new Bull;
            $bull->cattle_id = $cattle->id;
            $bull->save();
        });

        return redirect()->route('bulls.index');
    }

    public function show($id)
    {
        $bull = Bull::findOrFail($id);
        $vaccine_list = Vaccine::orderBy('name', 'asc')->get();
        $this->weight_chart($bull->cattle);
        return view('bulls.show', [
            'bull' => $bull,
            'breed'=>$bull->cattle->breed === NULL ? '' : $bull->cattle->breed->name,
            'owner' => $bull->cattle->owner === NULL ? '' : $bull->cattle->owner->name,
            'paddock' => $bull->cattle->paddock === NULL ? '' : $bull->cattle->paddock->name,
            'vaccine_list' => $vaccine_list,
            'weight_logs' => $bull->cattle->weightLog->sortByDesc("date"),
            'vaccine_logs' => $bull->cattle->vaccinationLog->sortByDesc("date"),
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

    public function update(UpdateBullRequest $request, $id)
    {
        $bull = Bull::findOrFail($id);
        $cattle = $bull->cattle;
        $cattle->tag = $request->cattle_tag;
        $cattle->birth = Carbon::createFromFormat('d/m/Y', $request->cattle_birth_date);
        $cattle->purchase_date = Carbon::createFromFormat('d/m/Y', $request->cattle_purchase_date);
        $cattle->breed_id = $request->cattle_breed;
        $cattle->owner_id = $request->cattle_owner;
        $cattle->paddock_id = $request->cattle_paddock;
        $cattle->is_alive = $request->cattle_is_alive;
        $cattle->control_tag = $request->control_tag;
        if($request->empadre_date != NULL)
            $cattle->empadre_date = Carbon::createFromFormat('d/m/Y', $request->empadre_date);
        $cattle->update();

        return redirect()->route('bulls.index');
    }

    public function destroy($id)
    {
        try
        {
            $bull = Bull::findOrFail($id);
            $bull->delete();
        }
        catch(\Exception $e)
        {
            $errors = array('El registro no puede ser eliminado.');
        }

        return redirect()->route('bulls.index');
    }

    public function log_weight(StoreUpdateLogWeightRequest $request, $id)
    {
        $bull = Bull::findOrFail($id);
        $log = new WeightLog;
        $log->weight = $request->weight;
        $log->date = Carbon::createFromFormat('d/m/Y', $request->date);
        $log->comment = $request->comment;
        $log->cattle_id = $bull->cattle_id;
        $log->save();

        return redirect()->route('bulls.show', $bull->id);
    }

    public function log_weight_delete(Request $request, $id)
    {
        $log = WeightLog::findOrFail($request->log_weight_id);
        $log->delete();

        return redirect()->route('bulls.show', $id);
    }

    public function log_vaccine(StoreUpdateLogVaccineRequest $request, $id)
    {
        $bull = Bull::findOrFail($id);
        $log = new VaccineLog;
        $log->date = Carbon::createFromFormat('d/m/Y', $request->date);
        $log->comment = $request->comment;
        $log->cattle_id = $bull->cattle_id;
        $log->vaccine_id = $request->vaccine;
        $log->save();

        return redirect()->route('bulls.show', $bull->id);
    }

    public function save_picture(StorePictureRequest $request, $id)
    {
        $bull = Bull::findOrFail($id);
        $pic = new Picture;

        if($request->hasFile('picture')) {
            $imageName = $bull->cattle_id . '-' . Carbon::now()->timestamp . '.' . $request->file('picture')->getClientOriginalExtension();
            $pic->filename = $imageName;

            $request->file('picture')->move(base_path() . '/public/images/', $imageName);
        }

        $pic->comment = $request->comment;
        $pic->cattle_id = $bull->cattle_id;
        $pic->save();

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
