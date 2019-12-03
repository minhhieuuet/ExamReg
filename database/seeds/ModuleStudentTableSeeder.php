<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleStudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('module_student')->truncate();

        DB::table('module_student')->insert([
            'exam_id' => 5,
            'module_id' => 1,
            'student_id' => 1,
            'status' => 1
        ]);

        DB::table('module_student')->insert([
            'exam_id' => 5,
            'module_id' => 1,
            'student_id' => 2,
            'status' => 1
        ]);

        DB::table('module_student')->insert([
            'exam_id' => 5,
            'module_id' => 1,
            'student_id' => 3,
            'status' => 1
        ]);

        DB::table('module_student')->insert([
            'exam_id' => 5,
            'module_id' => 1,
            'student_id' => 5,
            'status' => 1
        ]);

        DB::table('module_student')->insert([
            'exam_id' => 5,
            'module_id' => 4,
            'student_id' => 2,
            'status' => 1
        ]);

        DB::table('module_student')->insert([
            'exam_id' => 5,
            'module_id' => 2,
            'student_id' => 1,
            'status' => 1
        ]);

        DB::table('module_student')->insert([
            'exam_id' => 5,
            'module_id' => 3,
            'student_id' => 3,
            'status' => 1
        ]);

        DB::table('module_student')->insert([
            'exam_id' => 5,
            'module_id' => 4,
            'student_id' => 3,
            'status' => 1
        ]);

        DB::table('module_student')->insert([
            'exam_id' => 5,
            'module_id' => 1,
            'student_id' => 6,
            'status' => 1
        ]);

        DB::table('module_student')->insert([
            'exam_id' => 5,
            'module_id' => 5,
            'student_id' => 6,
            'status' => 1
        ]);
    }
}
