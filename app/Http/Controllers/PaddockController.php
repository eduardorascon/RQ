<?php

namespace App\Http\Controllers;

use App\Paddock;
use Illuminate\Http\Request;

class PaddockController extends Controller
{
    public function index()
    {
        $paddock = Paddock::all();
        return view('paddocks.index', [
            'paddocks' => $paddocks
        ]);
    }

    public function create()
    {
        return view('paddocks.create');
    }

    public function store(Request $request)
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

    public function update(Request $request, $id)
    {
        $paddock = Paddock::findOrFail($id);
        $paddock->update([
            'name' => $request->input('name')
        ]);
        return redirect()->route('paddocks.index');
    }

    public function destroy($id)
    {
        $paddock = Paddock::findOrFail($id);
        $paddock->delete();
        return redirect()->route('paddocks.index')
    }
}
