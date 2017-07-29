<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVaccinationLogTable extends Migration
{

    public function up()
    {
        Schema::create('vaccination_logs', function(Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->string('comment');
            $table->integer('cattle_id')->unsigned();
            $table->foreign('cattle_id')->references('id')->on('cattle');
            $table->integer('vaccine_id')->unsigned();
            $table->foreign('vaccine_id')->references('id')->on('vaccines');
        });
    }

    public function down()
    {
        Schema::dropIfExists('vaccination_logs');
    }
}
