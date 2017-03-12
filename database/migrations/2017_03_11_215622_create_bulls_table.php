<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBullsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bulls', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
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
        //
    }
}