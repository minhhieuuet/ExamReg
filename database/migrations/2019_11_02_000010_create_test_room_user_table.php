<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestRoomUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_room_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('test_room_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('candidate_number')->nullable();
            $table->unsignedInteger('ordinal_number')->nullable();
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
