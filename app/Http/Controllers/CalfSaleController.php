<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalfSaleController extends Controller
{
    public function index()
    {
    	return vieW('calves_sales.index');
    }
}
