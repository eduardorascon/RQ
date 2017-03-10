<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Role;

class AdminController extends Controller
{
    public function index()
    {
		$users = User::orderBy('created_at', 'asc')->get();
		return view('admin.index', ['users' => $users]);
    }

    public function assign_role(Request $request)
    {
        $user = User::where('email', $request['email'])->first();
        $user->roles()->detach();
        $user->roles()->attach(Role::where('name', $request['optionsRadios'])->first());
        return redirect()->back();
    }

    public function create_new_user(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        $user->roles()->attach(Role::where('name', 'User')->first());
        return redirect('/admin');
    }
}