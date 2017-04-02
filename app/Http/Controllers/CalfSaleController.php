<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Calf;

class CalfSaleController extends Controller
{
    public function index()
    {
		$is_search = isset($_GET['search']);
    	if($is_search == false)
    	{
            $calves = Calf::paginate(12);
    	}
        else{
            $calves = Calf::whereHas('cattle', function ($q) {
                $q->where('tag', 'LIKE', '%' . $_GET['search'] . '%');
            })->paginate(12);
        }

        return view('calves_sales.index', ['calves' => $calves]);
    }

    public function register_sale($calf_id)
    {
        $calf = Calf::findOrFail($calf_id);
        return view('calves_sales.create', [
            'calf'=>$calf]);
    }
}
