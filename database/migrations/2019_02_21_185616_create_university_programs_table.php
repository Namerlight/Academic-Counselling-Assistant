<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUniversityProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('university_programs', function (Blueprint $table) {
            $table->increments('university_id');
            $table->string('program_name');
            $table->float('ssc/a-level')->nullable();;
            $table->float('hsc/o-level')->nullable();;
            $table->float('cgpa(bachelor)')->nullable();
            $table->mediumText('others')->nullable();
            $table->mediumText('extra_notes')->nullable();
            $table->float('specific_fees')->nullable();

            //foreign key
            $table->foreign('university_id')
                ->references('id')
                ->on('universities')
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
        Schema::dropIfExists('university_programs');
    }
}
