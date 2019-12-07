<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_sessions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('test_site_id');
            $table->unsignedInteger('module_id');
            $table->bigInteger('started_at');
            $table->bigInteger('finished_at');
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
        Schema::dropIfExists('exam_sessions');
    }
}
