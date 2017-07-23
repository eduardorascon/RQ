<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalvesTable extends Migration
{

    public function up()
    {
        Schema::create('calves', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('cattle_id')->unsigned();
            $table->foreign('cattle_id')->references('id')->on('cattle');
            $table->integer('cow_id')->unsigned();
            $table->foreign('cow_id')->references('id')->on('cows');
            $table->integer('sale_id')->unsigned()->nullable();
            $table->foreign('sale_id')->references('id')->on('calves_sales');
        });
    }

    public function down()
    {
        Schema::dropIfExists('calves_sales');
    }
}
