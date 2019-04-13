<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUniversitiesRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('universities_requirements', function (Blueprint $table) {
            $table->increments('uni_id');
            $table->string('university_name')->unique();
            $table->double('gre_reqs');
            $table->double('ielts_reqs');
            $table->double('cgpa_reqs');
            $table->double('uni_score');

        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('universities_requirements');
    }
}
