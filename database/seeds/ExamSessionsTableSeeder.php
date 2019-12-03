<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExamSessionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('exam_sessions')->truncate();

        DB::table('exam_sessions')->insert([
            'test_site_id' => '5',
            'module_id' => '1',
            'started_at' => '123455',
            'finished_at' => '123456'
        ]);

        DB::table('exam_sessions')->insert([
            'test_site_id' => '5',
            'module_id' => '2',
            'started_at' => '123455',
            'finished_at' => '123456'
        ]);

        DB::table('exam_sessions')->insert([
            'test_site_id' => '5',
            'module_id' => '3',
            'started_at' => '123455',
            'finished_at' => '123456'
        ]);

        DB::table('exam_sessions')->insert([
            'test_site_id' => '5',
            'module_id' => '4',
            'started_at' => '123455',
            'finished_at' => '123456'
        ]);

        DB::table('exam_sessions')->insert([
            'test_site_id' => '5',
            'module_id' => '5',
            'started_at' => '123455',
            'finished_at' => '123456'
        ]);

        DB::table('exam_sessions')->insert([
            'test_site_id' => '5',
            'module_id' => '6',
            'started_at' => '123455',
            'finished_at' => '123456'
        ]);
    }
}
