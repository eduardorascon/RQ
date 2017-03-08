<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

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
}
