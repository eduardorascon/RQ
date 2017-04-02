<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalvesSalesTable extends Migration
{
    public function up()
    {
        Schema::create('calves_sales', function(Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->date('sale_date');
            $table->float('sale_weight', 8, 3);
            $table->float('price_per_kilo', 8, 3);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
