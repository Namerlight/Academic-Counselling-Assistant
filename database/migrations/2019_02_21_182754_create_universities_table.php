<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUniversitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //university basic information
        Schema::create('universities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->integer('qs_ranking');
            $table->string('research_output');
            $table->string('status');
            $table->string('graduate_employability_ranking');
            $table->integer('total_student');
            $table->float('average_fees');
            $table->string('country');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('universities');
    }
}
