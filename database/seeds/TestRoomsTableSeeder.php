<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestRoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('test_rooms')->truncate();

        DB::table('test_rooms')->insert([
            'exam_session_id' => '1',
            'room_id' => '1',
            'name' => 'Phòng thi số 1'
        ]);

        DB::table('test_rooms')->insert([
            'exam_session_id' => '1',
            'room_id' => '2',
            'name' => 'Phòng thi số 2'
        ]);

        DB::table('test_rooms')->insert([
            'exam_session_id' => '1',
            'room_id' => '3',
            'name' => 'Phòng thi số 3'
        ]);

        DB::table('test_rooms')->insert([
            'exam_session_id' => '1',
            'room_id' => '4',
            'name' => 'Phòng thi số 4'
        ]);

        DB::table('test_rooms')->insert([
            'exam_session_id' => '1',
            'room_id' => '5',
            'name' => 'Phòng thi số 5'
        ]);

        DB::table('test_rooms')->insert([
            'exam_session_id' => '1',
            'room_id' => '6',
            'name' => 'Phòng thi số 6'
        ]);

        DB::table('test_rooms')->insert([
            'exam_session_id' => '1',
            'room_id' => '7',
            'name' => 'Phòng thi số 7'
        ]);

        DB::table('test_rooms')->insert([
            'exam_session_id' => '1',
            'room_id' => '8',
            'name' => 'Phòng thi số 8'
        ]);
    }
}
