<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestRoomUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('test_room_user')->truncate();

        DB::table('test_room_user')->insert([
            'test_room_id' => 1,
            'user_id' => 2,
            'candidate_number' => 1,
            'ordinal_number' => 1
        ]);

        DB::table('test_room_user')->insert([
            'test_room_id' => 1,
            'user_id' => 2
        ]);

        DB::table('test_room_user')->insert([
            'test_room_id' => 1,
            'user_id' => 3
        ]);

        DB::table('test_room_user')->insert([
            'test_room_id' => 1,
            'user_id' => 4
        ]);

        DB::table('test_room_user')->insert([
            'test_room_id' => 1,
            'user_id' => 5
        ]);

        DB::table('test_room_user')->insert([
            'test_room_id' => 1,
            'user_id' => 6
        ]);

        DB::table('test_room_user')->insert([
            'test_room_id' => 1,
            'user_id' => 7
        ]);

        DB::table('test_room_user')->insert([
            'test_room_id' => 1,
            'user_id' => 8
        ]);

        DB::table('test_room_user')->insert([
            'test_room_id' => 1,
            'user_id' => 9
        ]);

        DB::table('test_room_user')->insert([
            'test_room_id' => 1,
            'user_id' => 10
        ]);

        DB::table('test_room_user')->insert([
            'test_room_id' => 2,
            'user_id' => 1
        ]);
    }
}
