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
            $table->string('is_alive');
            $table->string('gender');
            $table->integer('breed_id')->unsigned()->nullable();
            $table->foreign('breed_id')->references('id')->on('breeds');
            $table->integer('owner_id')->unsigned()->nullable();
            $table->foreign('owner_id')->references('id')->on('owners');
            $table->integer('paddock_id')->unsigned()->nullable();
            $table->foreign('paddock_id')->references('id')->on('paddocks');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cattle');
    }
}
