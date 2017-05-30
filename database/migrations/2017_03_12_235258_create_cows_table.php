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
            $table->timestamps();
            $table->string('is_fertile');
            $table->string('pregnancy_status');
            $table->date('last_pregnancy_check')->nullable();
            $table->integer('number_of_calves');
            $table->integer('cattle_id')->unsigned();
            $table->foreign('cattle_id')->references('id')->on('cattle');
        });
    }

    public function down()
    {
        //
    }
}
