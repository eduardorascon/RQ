<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Khill\Lavacharts\Lavacharts;

class TestChartController extends Controller
{
	public function index()
	{
		$this->exampleChart();
	}

    public function exampleChart()
    {
        $stocksTable = \Lava::DataTable();

        $stocksTable->addDateColumn('Day of Month')
                    ->addNumberColumn('Projected')
                    ->addNumberColumn('Official');

        // Random Data For Example
        for ($a = 1; $a < 10; $a++) {
            $stocksTable->addRow([
              '2015-10-' . $a, rand(800,1000), rand(800,1000)
            ]);
        }

        $chart = \Lava::LineChart('MyStocks', $stocksTable);
    }
}