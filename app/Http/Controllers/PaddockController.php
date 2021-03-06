<?php

namespace App\Http\Controllers;

use App\Paddock;
use App\Http\Requests\StoreUpdatePaddockRequest;
use Illuminate\Http\Request;

class PaddockController extends Controller
{
    public function index()
    {
        $paddocks = Paddock::all();
        return view('paddocks.index', [
            'paddocks' => $paddocks
        ]);
    }

    public function create()
    {
        return view('paddocks.create');
    }

    public function store(StoreUpdatePaddockRequest $request)
    {
        Paddock::create([
            'name' => $request->input('name')
        ]);
        return redirect()->route('paddocks.index');
    }

    public function show($id)
    {
        return Paddock::findOrFail($id);
    }

    public function edit($id)
    {
        $paddock = Paddock::findOrFail($id);
        return view('paddocks.edit', [
            'paddock' => $paddock
        ]);
    }

    public function update(StoreUpdatePaddockRequest $request, $id)
    {
        $paddock = Paddock::findOrFail($id);
        $paddock->update([
            'name' => $request->input('name')
        ]);
        return redirect()->route('paddocks.index');
    }

    public function destroy($id)
    {
        try
        {
            $paddock = Paddock::findOrFail($id);
            $paddock->delete();
        }
        catch (Exception $e)
        {
            $errors = array('El registro no puede ser eliminado.');
        }
        
        return redirect()->route('paddocks.index');
    }
}
