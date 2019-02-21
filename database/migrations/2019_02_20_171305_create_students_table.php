<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('school_name')->nullable();;
            $table->string('college_name')->nullable();;
            $table->string('college_group')->nullable();;
            $table->string('university')->nullable();;
            $table->float('ssc/a-level')->nullable();;
            $table->float('hsc/o-level')->nullable();;
            $table->float('cgpa(bachelor)')->nullable();
            $table->mediumText('others');

            //foreign key
            $table->foreign('id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('students');
    }
}
