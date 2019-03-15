<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateForeignKeyToCompetitiveEntranceExams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('competitive_entrance_exams', function (Blueprint $table) {
            $table->string('username')->after('student_id');
            $table->dropColumn('student_id');

            $table->foreign('username')
                ->references('username')
                ->on('users')
                ->onDelete('cascade')
                ->onUpate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('competitive_entrance_exams', function (Blueprint $table) {
            //
        });
    }
}
