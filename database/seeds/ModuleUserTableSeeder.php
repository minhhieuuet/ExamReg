<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('module_user')->truncate();

        DB::table('module_user')->insert([
            'exam_id' => 5,
            'module_id' => 1,
            'user_id' => 2,
            'status' => 1
        ]);

        DB::table('module_user')->insert([
            'exam_id' => 5,
            'module_id' => 1,
            'user_id' => 2,
            'status' => 1
        ]);

        DB::table('module_user')->insert([
            'exam_id' => 5,
            'module_id' => 1,
            'user_id' => 3,
            'status' => 1
        ]);

        DB::table('module_user')->insert([
            'exam_id' => 5,
            'module_id' => 1,
            'user_id' => 5,
            'status' => 1
        ]);

        DB::table('module_user')->insert([
            'exam_id' => 5,
            'module_id' => 4,
            'user_id' => 2,
            'status' => 1
        ]);

        DB::table('module_user')->insert([
            'exam_id' => 5,
            'module_id' => 2,
            'user_id' => 1,
            'status' => 1
        ]);

        DB::table('module_user')->insert([
            'exam_id' => 5,
            'module_id' => 3,
            'user_id' => 3,
            'status' => 1
        ]);

        DB::table('module_user')->insert([
            'exam_id' => 5,
            'module_id' => 4,
            'user_id' => 3,
            'status' => 1
        ]);

        DB::table('module_user')->insert([
            'exam_id' => 5,
            'module_id' => 1,
            'user_id' => 6,
            'status' => 1
        ]);

        DB::table('module_user')->insert([
            'exam_id' => 5,
            'module_id' => 5,
            'user_id' => 6,
            'status' => 1
        ]);
    }
}
