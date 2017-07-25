<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCowsTable extends Migration
{
    public function up()
    {
        Schema::create('cows', function (Blueprint $table) {
            $table->increments('id');
            $table->string('is_fertile');
            $table->string('pregnancy_status');
            $table->date('last_pregnancy_check')->nullable();
            $table->integer('number_of_calves');
            $table->integer('cattle_id')->unsigned();
            $table->foreign('cattle_id')->references('id')->on('cattle');
            $table->integer('sale_id')->unsigned()->nullable();
            $table->foreign('sale_id')->references('id')->on('cows_sales');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cows');
    }
}
