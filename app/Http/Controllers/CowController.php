<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCowRequest;
use App\Http\Requests\UpdateCowRequest;
use App\Http\Requests\StoreUpdateLogWeightRequest;
use App\Http\Requests\StoreUpdateLogVaccineRequest;
use App\Http\Requests\StorePictureRequest;
use App\Http\Requests\StoreLogPalpationRequest;
use App\Cow;
use App\CowView;
use App\CalfView;
use App\Cattle;
use App\Breed;
use App\Owner;
use App\Paddock;
use App\WeightLog;
use App\Vaccine;
use App\VaccineLog;
use App\PalpationLog;
use App\Picture;
use Carbon\Carbon;
use Khill\Lavacharts\Lavacharts;
Use DB;

class CowController extends Controller
{
    public function index()
    {
        $cows = CowView::sortable()->orderBy('id', 'asc')->paginate(9);
        $total_cows = CowView::count();

        return view('cows.index', [
            'cows' => $cows,
            'total_cows' => $total_cows
        ]);
    }

    public function create()
    {
        $breed_list = Breed::orderBy('name', 'asc')->get();
        $owner_list = Owner::orderBy('name', 'asc')->get();
        $paddock_list = Paddock::orderBy('name', 'asc')->get();
        return view('cows.create', [
            'breed_list'=>$breed_list,
            'owner_list'=>$owner_list,
            'paddock_list'=>$paddock_list
        ]);
    }

    public function store(StoreCowRequest $request)
    {
        DB::transaction(function() use ($request) {
            $cattle = new Cattle;
            $cattle->tag = $request->cattle_tag;
            $cattle->birth = Carbon::createFromFormat('d/m/Y', $request->cattle_birth_date);
            $cattle->purchase_date = $request->cattle_purchase_date === NULL ? NULL : Carbon::createFromFormat('d/m/Y', $request->cattle_purchase_date);
            $cattle->breed_id = $request->cattle_breed;
            $cattle->owner_id = $request->cattle_owner;
            $cattle->paddock_id = $request->cattle_paddock;
            $cattle->gender = 'Hembra';
            $cattle->is_alive = $request->cattle_is_alive;
            $cattle->control_tag = $request->control_tag;
            if($request->empadre_date != NULL)
                $cattle->empadre_date = Carbon::createFromFormat('d/m/Y', $request->empadre_date);
            $cattle->save();

            $cow = new Cow;
            $cow->cattle_id = $cattle->id;
            $cow->is_fertile = $request->cow_fertility;
            $cow->pregnancy_status = 'Vacia';
            $cow->number_of_calves = $request->cow_number_of_calves;
            $cow->save();
        });

        return redirect()->route('cows.index');
    }

    public function show($id)
    {
        $cow = Cow::findOrFail($id);
        $vaccine_list = Vaccine::orderBy('name', 'asc')->get();
        $offspring = CalfView::where('calves_view.mother_id', '=', $id)->orderBy('calves_view.tag', 'asc')->get();
        $this->weight_chart($cow->cattle);
        return view('cows.show', [
            'cow'=>$cow,
            'breed'=>$cow->cattle->breed === NULL ? '' : $cow->cattle->breed->name,
            'owner'=>$cow->cattle->owner === NULL ? '' : $cow->cattle->owner->name,
            'paddock'=>$cow->cattle->paddock === NULL ? '' : $cow->cattle->paddock->name,
            'vaccine_list'=>$vaccine_list,
            'weight_logs'=>$cow->cattle->weightLog->sortByDesc("date"),
            'vaccine_logs'=>$cow->cattle->vaccinationLog->sortByDesc("date"),
            'offspring'=>$offspring,
            'palpations'=>$cow->palpationLog->sortByDesc('date'),
            'pictures'=>$cow->cattle->pictures->sortBy('filename')
        ]);
    }

    public function edit($id)
    {
        $cow = Cow::findOrFail($id);
        $breed_list = Breed::orderBy('name', 'asc')->get();
        $owner_list = Owner::orderBy('name', 'asc')->get();
        $paddock_list = Paddock::orderBy('name', 'asc')->get();
        return view('cows.edit', [
            'cow'=>$cow,
            'breed_list'=>$breed_list,
            'owner_list'=>$owner_list,
            'paddock_list'=>$paddock_list
        ]);
    }

    public function update(UpdateCowRequest $request, $id)
    {
        $cow = Cow::findOrFail($id);
        $cow->is_fertile = $request->cow_fertility;
        $cow->pregnancy_status = $request->cow_pregnancy_status;
        $cow->number_of_calves = $request->cow_number_of_calves;
        $cow->update();

        $cattle = $cow->cattle;
        $cattle->tag = $request->cattle_tag;
        $cattle->birth = Carbon::createFromFormat('d/m/Y', $request->cattle_birth_date);
        $cattle->purchase_date = $request->cattle_purchase_date === NULL ? NULL : Carbon::createFromFormat('d/m/Y', $request->cattle_purchase_date);
        $cattle->breed_id = $request->cattle_breed;
        $cattle->owner_id = $request->cattle_owner;
        $cattle->paddock_id = $request->cattle_paddock;
        $cattle->is_alive = $request->cattle_is_alive;
        $cattle->control_tag = $request->control_tag;
        if($request->empadre_date != NULL)
            $cattle->empadre_date = Carbon::createFromFormat('d/m/Y', $request->empadre_date);
        $cattle->update();

        return redirect()->route('cows.index');
    }

    public function destroy($id)
    {
        try
        {
            $cow = Cow::findOrFail($id);
            $cow->delete();
        }
        catch (\Exception $e)
        {
            $errors = array('El registro no puede ser eliminado.');
        }

        return redirect()->route('cows.index');
    }

    public function log_weight(StoreUpdateLogWeightRequest $request, $id)
    {
        $cow = Cow::findOrFail($id);
        $log = new WeightLog;
        $log->weight = $request->weight;
        $log->date = Carbon::createFromFormat('d/m/Y', $request->date);
        $log->comment = $request->comment;
        $log->cattle_id = $cow->cattle_id;
        $log->save();

        return redirect()->route('cows.show', $cow->id);
    }

    public function log_weight_delete(Request $request, $id)
    {
        $log = WeightLog::findOrFail($request->log_weight_id);
        $log->delete();

        return redirect()->route('cows.show', $id);
    }

    public function log_vaccine(StoreUpdateLogVaccineRequest $request, $id)
    {
        $cow = Cow::findOrFail($id);
        $log = new VaccineLog;
        $log->date = Carbon::createFromFormat('d/m/Y', $request->date);
        $log->comment = $request->comment;
        $log->cattle_id = $cow->cattle_id;
        $log->vaccine_id = $request->vaccine;
        $log->save();

        return redirect()->route('cows.show', $cow->id);
    }

    public function log_palpation(StoreLogPalpationRequest $request, $id)
    {
        $log = new PalpationLog;
        $log->months = $request->months;
        $log->date = Carbon::createFromFormat('d/m/Y', $request->date);
        $log->comment = $request->comment;
        $log->cow_id = $id;
        $log->save();

        return redirect()->route('cows.show', $id);
    }

    public function save_picture(StorePictureRequest $request, $id)
    {
        $cow = Cow::findOrFail($id);
        $pic = new Picture;

        if($request->hasFile('picture')) {
            $imageName = $cow->cattle_id . '-' . Carbon::now()->timestamp . '.' . $request->file('picture')->getClientOriginalExtension();
            $pic->filename = $imageName;

            $request->file('picture')->move(base_path() . '/public/images/', $imageName);
        }

        $pic->comment = $request->comment;
        $pic->cattle_id = $cow->cattle_id;
        $pic->save();

        return redirect()->route('cows.show', $cow->id);
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
