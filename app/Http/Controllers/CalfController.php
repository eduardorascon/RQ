<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Calf;
use App\Cattle;
use App\Breed;

class CalfController extends Controller
{
    public function index()
    {
        $calfs = Calf::all();
        return view('calfs.index', ['calfs' => $calfs]);
    }

    public function create()
    {
        $breed_list = Breed::orderBy('name', 'asc')->get();
        return view('calfs.create', ['breed_list'=>$breed_list]);
    }

    public function store(Request $request)
    {
        $cattle = new Cattle;
        $cattle->tag = $request->cattle_tag;
        $cattle->birth = $request->cattle_birth_date;
        $cattle->purchase_date = $request->cattle_purchase_date;
        $cattle->breed_id = $request->cattle_breed;
        $cattle->save();

        $calf = new Calf;
        $calf->cattle_id = $cattle->id;
        $calf->save();

        return redirect()->route('calfs.index');
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
}
