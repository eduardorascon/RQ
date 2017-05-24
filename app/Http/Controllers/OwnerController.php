<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Owner;

class OwnerController extends Controller
{
    public function index()
    {
        $owners = Owner::all();
        return view('owners.index', [
            'owners' => $owners
        ]);
    }

    public function create()
    {
        return view('owners.create');
    }

    public function store(Request $request)
    {
        Owner::create([
            'name' => $request->input('name')
        ]);
        return redirect()->route('owners.index');
    }

    public function show($id)
    {
        return Owner::findOrFail($id);
    }

    public function edit($id)
    {
        $owner = Owner::findOrFail($id);
        return view('owners.edit', compact('owner'));
    }

    public function update(Request $request, $id)
    {
        $owner = Owner::findOrFail($id);
        $owner->update([
            'name' => $request->input('name')
        ]);
        return redirect()->route('owners.index');
    }

    public function destroy($id)
    {
        $owner = Owner::findOrFail($id);
        $owner->delete();
        return redirect()->route('owners.index');
    }
}
