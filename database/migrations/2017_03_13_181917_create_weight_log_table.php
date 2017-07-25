<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeightLogTable extends Migration
{

    public function up()
    {
        Schema::create('weight_logs', function(Blueprint $table) {
            $table->increments('id');
            $table->float('weight', 8, 3);
            $table->date('date');
            $table->string('comment');
            $table->integer('cattle_id')->unsigned();
            $table->foreign('cattle_id')->references('id')->on('cattle');
        });
    }

    public function down()
    {
        Schema::dropIfExists('weight_log');
    }
}
