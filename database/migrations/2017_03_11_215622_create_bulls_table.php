<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBullsTable extends Migration
{
    public function up()
    {
        Schema::create('bulls', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cattle_id')->unsigned();
            $table->foreign('cattle_id')->references('id')->on('cattle');
            $table->integer('sale_id')->unsigned()->nullable();
            $table->foreign('sale_id')->references('id')->on('bulls_sales');
        });
    }

    public function down()
    {
        Schema::dropIfExists('bulls');
    }
}
