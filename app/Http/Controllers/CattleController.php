<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCattleRequest;
use App\AllCattleView;
use App\Bull;
use App\Cow;
use App\Calf;
use App\Cattle;
use App\Breed;
use App\Owner;
use App\Paddock;
use Carbon\Carbon;
use Khill\Lavacharts\Lavacharts;
use DB;

class CattleController extends Controller
{
    public function index()
    {
        $all_cattle = AllCattleView::sortable()->orderBy('id', 'asc')->paginate(9);
        $contador = AllCattleView::count();

        return view('cattle.index', [
            'CONTADOR' => $contador,
            'all_cattle' => $all_cattle
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

        return view('cattle.create', [
            'breed_list'=>$breed_list,
            'owner_list'=>$owner_list,
            'paddock_list'=>$paddock_list,
            'cow_list'=>$cow_list
        ]);
    }

    public function store(StoreCattleRequest $request)
    {
        $cattle = new Cattle;
        $cattle->tag = $request->cattle_tag;
        $cattle->birth = Carbon::createFromFormat('d/m/Y', $request->cattle_birth_date);
        $cattle->purchase_date = $request->cattle_purchase_date === NULL ? NULL : Carbon::createFromFormat('d/m/Y', $request->cattle_purchase_date);
        $cattle->breed_id = $request->cattle_breed;
        $cattle->owner_id = $request->cattle_owner;
        $cattle->paddock_id = $request->cattle_paddock;
        $cattle->is_alive = $request->cattle_is_alive;
        $cattle->control_tag = $request->control_tag;
        $cattle->empadre_date = $request->empadre_date === NULL ? NULL : Carbon::createFromFormat('d/m/Y', $request->empadre_date);

        if($request->inlineRadioOptions == 'Becerro') {
            $cattle->gender = $request->cattle_gender;

            $cattle->save();

            $cow_id = $request->cow_id;
            $cow = Cow::findOrFail($cow_id);

            $calf = new Calf;
            $calf->cattle_id = $cattle->id;
            $calf->cow_id = $cow->id;
            $calf->save();
        }

        if($request->inlineRadioOptions == 'Toro') {
            $cattle->gender = 'Macho';

            $cattle->save();

            $bull = new Bull;
            $bull->cattle_id = $cattle->id;
            $bull->save();
        }

        if($request->inlineRadioOptions == 'Vaca') {
            $cattle->gender = 'Hembra';

            $cattle->save();

            $cow = new Cow;
            $cow->cattle_id = $cattle->id;
            $cow->is_fertile = $request->cow_fertility;
            $cow->pregnancy_status = $request->cow_pregnancy_status;
            $cow->number_of_calves = $request->cow_number_of_calves;
            $cow->save();
        }

        return redirect()->route('cattle.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
