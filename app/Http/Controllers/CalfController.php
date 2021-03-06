<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCalfRequest;
use App\Http\Requests\UpdateCalfRequest;
use App\Http\Requests\StoreUpdateLogWeightRequest;
use App\Http\Requests\StoreUpdateLogVaccineRequest;
use App\Http\Requests\StorePictureRequest;
use App\Calf;
use App\CalfView;
use App\Cattle;
use App\Breed;
use App\Owner;
use App\Paddock;
use App\WeightLog;
use App\Vaccine;
use App\VaccineLog;
use App\Cow;
use App\Picture;
use Carbon\Carbon;
use Khill\Lavacharts\Lavacharts;
use DB;

class CalfController extends Controller
{
    public function index()
    {
        $calves = CalfView::sortable()->orderBy('id', 'asc')->paginate(9);
        $total_calves = CalfView::count();

        return view('calves.index', [
            'calves' => $calves,
            'total_calves' => $total_calves
        ]);
    }

    public function create()
    {
        $breed_list = Breed::orderBy('name', 'asc')->get();
        $owner_list = Owner::orderBy('name', 'asc')->get();
        $paddock_list = Paddock::orderBy('name', 'asc')->get();
        $cow_list = Cow::whereHas('cattle', function ($q) {
            $q->orderBy('tag', 'asc');
        })->with('cattle')->get();

        return view('calves.create', [
            'breed_list'=>$breed_list,
            'owner_list'=>$owner_list,
            'paddock_list'=>$paddock_list,
            'cow_list'=>$cow_list
        ]);
    }

    public function create_offspring($cow_id)
    {
        $breed_list = Breed::orderBy('name', 'asc')->get();
        $owner_list = Owner::orderBy('name', 'asc')->get();
        $paddock_list = Paddock::orderBy('name', 'asc')->get();
        $cow = Cow::findOrFail($cow_id);

        return view('calves.create', [
            'breed_list'=>$breed_list,
            'owner_list'=>$owner_list,
            'paddock_list'=>$paddock_list,
            'cow'=>$cow
        ]);
    }

    public function store(StoreCalfRequest $request)
    {
        DB::transaction(function() use ($request) {
            $cow_id = $request->cow_id;
            $cow = Cow::findOrFail($cow_id);

            $cattle = new Cattle;
            $cattle->tag = $request->cattle_tag;
            $cattle->birth = Carbon::createFromFormat('d/m/Y', $request->cattle_birth_date);
            $cattle->purchase_date = $request->cattle_purchase_date === NULL ? $cattle->birth : Carbon::createFromFormat('d/m/Y', $request->cattle_purchase_date);

            $cattle->breed_id = $request->cattle_breed;
            $cattle->owner_id = $request->cattle_owner;
            $cattle->paddock_id = $request->cattle_paddock;
            $cattle->gender = $request->cattle_gender;
            $cattle->is_alive = $request->cattle_is_alive;
            $cattle->control_tag = $request->control_tag;
            if($request->empadre_date != NULL)
                $cattle->empadre_date = Carbon::createFromFormat('d/m/Y', $request->empadre_date);
            $cattle->save();

            $calf = new Calf;
            $calf->cattle_id = $cattle->id;
            $calf->cow_id = $cow->id;
            $calf->save();
        });

        return redirect()->route('calves.index');
    }

    public function show($id)
    {
        $calf = Calf::findOrFail($id);
        $vaccine_list = Vaccine::orderBy('name', 'asc')->get();
        $this->weight_chart($calf->cattle);
        return view('calves.show', [
            'calf'=>$calf,
            'breed'=>$calf->cattle->breed === NULL ? '' : $calf->cattle->breed->name,
            'owner'=>$calf->cattle->owner === NULL ? '' : $calf->cattle->owner->name,
            'paddock'=>$calf->cattle->paddock === NULL ? '' : $calf->cattle->paddock->name,
            'vaccine_list'=>$vaccine_list,
            'weight_logs'=>$calf->cattle->weightLog->sortByDesc("date"),
            'vaccine_logs'=>$calf->cattle->vaccinationLog->sortByDesc("date"),
            'pictures'=>$calf->cattle->pictures->sortBy('filename')]);
    }

    public function edit($id)
    {
        $calf = Calf::findOrFail($id);
        $breed_list = Breed::orderBy('name', 'asc')->get();
        $owner_list = Owner::orderBy('name', 'asc')->get();
        $paddock_list = Paddock::orderBy('name', 'asc')->get();
        return view('calves.edit', [
            'calf'=>$calf,
            'breed_list'=>$breed_list,
            'owner_list'=>$owner_list,
            'paddock_list'=>$paddock_list
        ]);
    }

    public function update(UpdateCalfRequest $request, $id)
    {
        $calf = Calf::findOrFail($id);
        $cattle = $calf->cattle;
        $cattle->tag = $request->cattle_tag;
        if($request->cattle_birth_date != NULL)
            $cattle->birth = Carbon::createFromFormat('d/m/Y', $request->cattle_birth_date);
        $cattle->purchase_date = $request->cattle_purchase_date === NULL ? NULL : Carbon::createFromFormat('d/m/Y', $request->cattle_purchase_date);
        $cattle->breed_id = $request->cattle_breed;
        $cattle->owner_id = $request->cattle_owner;
        $cattle->paddock_id = $request->cattle_paddock;
        $cattle->gender = $request->cattle_gender;
        $cattle->is_alive = $request->cattle_is_alive;
        $cattle->control_tag = $request->control_tag;
        if($request->empadre_date != NULL)
            $cattle->empadre_date = Carbon::createFromFormat('d/m/Y', $request->empadre_date);
        $cattle->update();

        return redirect()->route('calves.index');
    }

    public function destroy($id)
    {
        try{
            $calf = Calf::findOrFail($id);
            $calf->delete();
        }
        catch(\Exception $e)
        {
            $errors = array('El registro no puede ser eliminado.');
        }

        return redirect()->route('calves.index');
    }

    public function log_weight(StoreUpdateLogWeightRequest $request, $id)
    {
        $calf = Calf::findOrFail($id);
        $log = new WeightLog;
        $log->weight = $request->weight;
        $log->date = Carbon::createFromFormat('d/m/Y', $request->date);
        $log->comment = $request->comment;
        $log->cattle_id = $calf->cattle_id;
        $log->save();

        return redirect()->route('calves.show', $calf->id);
    }

    public function log_weight_delete(Request $request, $id)
    {
        $log = WeightLog::findOrFail($request->log_weight_id);
        $log->delete();

        return redirect()->route('calves.show', $id);
    }

    public function log_vaccine(StoreUpdateLogVaccineRequest $request, $id)
    {
        $calf = Calf::findOrFail($id);
        $log = new VaccineLog;
        $log->date = Carbon::createFromFormat('d/m/Y', $request->date);
        $log->comment = $request->comment;
        $log->cattle_id = $calf->cattle_id;
        $log->vaccine_id = $request->vaccine;
        $log->save();

        return redirect()->route('calves.show', $calf->id);
    }

    public function save_picture(StorePictureRequest $request, $id)
    {
        $this->validate($request, ['comment'=> 'required']);

        $calf = Calf::findOrFail($id);
        $pic = new Picture;

        if($request->hasFile('picture')) {
            $imageName = $calf->cattle_id . '-' . Carbon::now()->timestamp . '.' . $request->file('picture')->getClientOriginalExtension();
            $pic->filename = $imageName;

            $request->file('picture')->move(base_path() . '/public/images/', $imageName);
        }

        $pic->comment = $request->comment;
        $pic->cattle_id = $calf->cattle_id;
        $pic->save();

        return redirect()->route('calves.show', $calf->id);
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
