<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTraningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tranings', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('description');
            $table->date('debut');
            $table->date('fin');
            $table->biginteger('cv_id')->unsigned();
            $table->foreign('cv_id')->references('id')->on('cvs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tranings');
    }
}
