<?php

//use App\Models\University;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UniversitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('universities')->truncate();
//        factory(University::class, 10)->create();

        DB::table('universities')->insert([
            'name' => 'Trường Đại học Khoa học Tự nhiên',
            'short_name' => 'HUS'
        ]);

        DB::table('universities')->insert([
            'name' => 'Trường Đại học Khoa học Xã hội và Nhân văn',
            'short_name' => 'USSH'
        ]);

        DB::table('universities')->insert([
            'name' => 'Trường Đại học Ngoại ngữ',
            'short_name' => 'ULIS'
        ]);

        DB::table('universities')->insert([
            'name' => 'Trường Đại học Công nghệ',
            'short_name' => 'UET'
        ]);

        DB::table('universities')->insert([
            'name' => 'Trường Đại học Kinh tế',
            'short_name' => 'UEB'
        ]);

        DB::table('universities')->insert([
            'name' => 'Trường Đại học Giáo dục',
            'short_name' => 'UED'
        ]);

        DB::table('universities')->insert([
            'name' => 'Trường Đại học Việt - Nhật',
            'short_name' => 'VJU'
        ]);

        DB::table('universities')->insert([
            'name' => 'Khoa Luật',
            'short_name' => 'SOL'
        ]);

        DB::table('universities')->insert([
            'name' => 'Khoa Y Dược',
            'short_name' => 'SMP'
        ]);

        DB::table('universities')->insert([
            'name' => 'Khoa Quản trị và Kinh doanh',
            'short_name' => 'HSB'
        ]);

        DB::table('universities')->insert([
            'name' => 'Khoa Quốc tế',
            'short_name' => 'IS'
        ]);
    }
}
