<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePalpationsLogTable extends Migration
{
    public function up()
    {
        Schema::create('palpation_logs', function(Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->float('months', 8, 1);
            $table->date('date');
            $table->string('comment');
            $table->integer('cow_id')->unsigned();
            $table->foreign('cow_id')->references('id')->on('cows');
        });
    }

    public function down()
    {
        Schema::dropIfExists('palpation_logs');
    }
}
