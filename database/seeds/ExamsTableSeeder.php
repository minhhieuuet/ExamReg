<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('exams')->insert([
            'name' => 'Học kì 1 - Năm học 2018-2019',
        ]);

        DB::table('exams')->insert([
            'name' => 'Học kì 2 - Năm học 2018-2019',
        ]);

        DB::table('exams')->insert([
            'name' => 'Học kì 1 - Năm học 2019-2020',
        ]);
    }
}
