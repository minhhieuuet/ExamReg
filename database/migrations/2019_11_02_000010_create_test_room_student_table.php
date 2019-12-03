<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestRoomStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_room_student', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('test_room_id');
            $table->unsignedInteger('student_id');
            $table->unsignedInteger('candidate_number');
            $table->unsignedInteger('ordinal_number');
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
        Schema::dropIfExists('test_room_student');
    }
}
