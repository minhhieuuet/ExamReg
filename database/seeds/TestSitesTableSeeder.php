<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestSitesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('test_sites')->insert([
            'exam_id' => '1',
            'name' => 'Trường Đại học Công nghệ'
        ]);

        DB::table('test_sites')->insert([
            'exam_id' => '1',
            'name' => 'Trường Đại học Ngoại ngữ'
        ]);

        DB::table('test_sites')->insert([
            'exam_id' => '2',
            'name' => 'Trường Đại học Công nghệ'
        ]);

        DB::table('test_sites')->insert([
            'exam_id' => '2',
            'name' => 'Trường Đại học Khoa học Xã hội và Nhân văn'
        ]);

        DB::table('test_sites')->insert([
            'exam_id' => '3',
            'name' => 'Trường Đại học Công nghệ'
        ]);

        DB::table('test_sites')->insert([
            'exam_id' => '3',
            'name' => 'Trường Đại học Khoa học Tự nhiên'
        ]);
    }
}
