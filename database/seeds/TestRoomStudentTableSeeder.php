<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestRoomStudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('test_room_student')->truncate();

        DB::table('test_room_student')->insert([
            'test_room_id' => 1,
            'student_id' => 1,
            'candidate_number' => 1,
            'ordinal_number' => 1
        ]);

        DB::table('test_room_student')->insert([
            'test_room_id' => 1,
            'student_id' => 2
        ]);

        DB::table('test_room_student')->insert([
            'test_room_id' => 1,
            'student_id' => 3
        ]);

        DB::table('test_room_student')->insert([
            'test_room_id' => 1,
            'student_id' => 4
        ]);

        DB::table('test_room_student')->insert([
            'test_room_id' => 1,
            'student_id' => 5
        ]);

        DB::table('test_room_student')->insert([
            'test_room_id' => 1,
            'student_id' => 6
        ]);

        DB::table('test_room_student')->insert([
            'test_room_id' => 1,
            'student_id' => 7
        ]);

        DB::table('test_room_student')->insert([
            'test_room_id' => 1,
            'student_id' => 8
        ]);

        DB::table('test_room_student')->insert([
            'test_room_id' => 1,
            'student_id' => 9
        ]);

        DB::table('test_room_student')->insert([
            'test_room_id' => 1,
            'student_id' => 10
        ]);

        DB::table('test_room_student')->insert([
            'test_room_id' => 2,
            'student_id' => 1
        ]);
    }
}
