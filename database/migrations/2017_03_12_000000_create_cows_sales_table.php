<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCowsSalesTable extends Migration
{
    public function up()
    {
        Schema::create('cows_sales', function (Blueprint $table) {
            $table->increments('id');
            $table->date('sale_date');
            $table->float('sale_weight', 8, 3);
            $table->float('price_per_kilo', 8, 3);
            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('clients');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cows_sales');
    }
}
