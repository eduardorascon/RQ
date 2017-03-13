<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeightLogTable extends Migration
{

    public function up()
    {
        Schema::create('weight_log', function(Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->float('wight', 8, 3);
            $table->date('weight_date');
            $table->integer('cattle_id')->unsigned();
            $table->foreign('cattle_id')->references('id')->on('cattle');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weight_log');
    }
}
