<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetitiveEntranceExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competitive_entrance_exams', function (Blueprint $table) {
            $table->increments('student_id');
            $table->float('ielts')->nullable();
            $table->float('sat')->nullable();
            $table->float('gre')->nullable();
            $table->float('toefl')->nullable();
            $table->float('gmat')->nullable();


            //foreign key
            $table->foreign('student_id')
                ->references('id')
                ->on('students')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('competitive__entrance__exams');
    }
}
