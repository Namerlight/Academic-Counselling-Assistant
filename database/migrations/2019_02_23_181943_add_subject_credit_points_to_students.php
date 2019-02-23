<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubjectCreditPointsToStudents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('bachelor_subject')->after('hsc/o-level')->nullable();
            $table->string('bachelor_credit')->after('bachelor_subject')->nullable();
            $table->float('academic_point')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('bachelor_subject');
            $table->dropColumn('bachelor_credit');
            $table->dropColumn('academic_point');
        });
    }
}
