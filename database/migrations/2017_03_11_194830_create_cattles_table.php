<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCattlesTable extends Migration
{

    public function up()
    {
        Schema::create('cattle', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('tag');
            $table->date('purchase_date');
            $table->date('birth');
            $table->date('is_dead');
            $table->string('gender');
            $table->integer('breed_id')->unsigned();
            $table->foreign('breed_id')->references('id')->on('breeds');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cattle');
    }
}
