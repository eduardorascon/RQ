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
		return view('admin.index', [
			'users' => $users,
			'as' => 'admin',
			'middleware' => 'roles',
			'roles' => ['Admin']
			]);
    }

    public function postAdminAssignRoles(Request $request)
    {
        $user = User::where('email', $request['email'])->first();
        $user->roles()->detach();
        $user->roles()->attach(Role::where('name', $request['optionsRadios'.$request['id']])->first());
        return redirect()->back();
    }
}
