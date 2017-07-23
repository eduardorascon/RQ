<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePicturesTable extends Migration
{
    public function up()
    {
        Schema::create('pictures', function(Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('filename');
            $table->string('comment');
            $table->integer('cattle_id')->unsigned();
            $table->foreign('cattle_id')->references('id')->on('cattle');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pictures');
    }
}
