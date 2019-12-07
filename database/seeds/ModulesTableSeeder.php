<?php

//use App\Models\Module;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modules')->truncate();
//        factory(Module::class, 10)->create();

        DB::table('modules')->insert([
            'name' => 'Toán trong công nghệ',
            'code' => 'ELT2029 1',
            'subject_code' => 'ELT2029'
        ]);

        DB::table('modules')->insert([
            'name' => 'Toán trong công nghệ',
            'code' => 'ELT2029 2',
            'subject_code' => 'ELT2029'
        ]);

        DB::table('modules')->insert([
            'name' => 'Toán trong công nghệ',
            'code' => 'ELT2029 3',
            'subject_code' => 'ELT2029'
        ]);

        DB::table('modules')->insert([
            'name' => 'Toán trong công nghệ',
            'code' => 'ELT2029 4',
            'subject_code' => 'ELT2029'
        ]);

        DB::table('modules')->insert([
            'name' => 'Phát triển ứng dụng web',
            'code' => 'INT3306 1',
            'subject_code' => 'INT3306'
        ]);

        DB::table('modules')->insert([
            'name' => 'Phát triển ứng dụng web',
            'code' => 'INT3306 2',
            'subject_code' => 'INT3306'
        ]);

        DB::table('modules')->insert([
            'name' => 'Phát triển ứng dụng web',
            'code' => 'INT3306 3',
            'subject_code' => 'INT3306'
        ]);

        DB::table('modules')->insert([
            'name' => 'Phát triển ứng dụng web',
            'code' => 'INT3306 4',
            'subject_code' => 'INT3306'
        ]);

        DB::table('modules')->insert([
            'name' => 'Giải tích 1',
            'code' => 'ATID318 1',
            'subject_code' => 'ATID318'
        ]);

        DB::table('modules')->insert([
            'name' => 'Giải tích 1',
            'code' => 'ATID318 2',
            'subject_code' => 'ATID318'
        ]);

        DB::table('modules')->insert([
            'name' => 'Giải tích 1',
            'code' => 'ATID318 3',
            'subject_code' => 'ATID318'
        ]);

        DB::table('modules')->insert([
            'name' => 'Giải tích 2',
            'code' => 'ATID379 1',
            'subject_code' => 'ATID379'
        ]);

        DB::table('modules')->insert([
            'name' => 'Giải tích 2',
            'code' => 'ATID379 2',
            'subject_code' => 'ATID379'
        ]);

        DB::table('modules')->insert([
            'name' => 'Giải tích 2',
            'code' => 'ATID379 3',
            'subject_code' => 'ATID379'
        ]);

        DB::table('modules')->insert([
            'name' => 'Cơ và nhiệt',
            'code' => 'SSNI154 1',
            'subject_code' => 'SSNI154'
        ]);

        DB::table('modules')->insert([
            'name' => 'Cơ và nhiệt',
            'code' => 'SSNI154 2',
            'subject_code' => 'SSNI154'
        ]);

        DB::table('modules')->insert([
            'name' => 'Cơ và nhiệt',
            'code' => 'SSNI154 3',
            'subject_code' => 'SSNI154'
        ]);

        DB::table('modules')->insert([
            'name' => 'Điện và quang',
            'code' => 'SSNI157 1',
            'subject_code' => 'SSNI157'
        ]);

        DB::table('modules')->insert([
            'name' => 'Điện và quang',
            'code' => 'SSNI157 2',
            'subject_code' => 'SSNI157'
        ]);

        DB::table('modules')->insert([
            'name' => 'Điện và quang',
            'code' => 'SSNI157 3',
            'subject_code' => 'SSNI157'
        ]);

        DB::table('modules')->insert([
            'name' => 'Tín hiệu và hệ thống',
            'code' => 'DASD572 1',
            'subject_code' => 'DASD572'
        ]);

        DB::table('modules')->insert([
            'name' => 'Triết học Marx-Lenin 1',
            'code' => 'SHKD797 1',
            'subject_code' => 'SHKD797'
        ]);

        DB::table('modules')->insert([
            'name' => 'Triết học Marx-Lenin 1',
            'code' => 'SHKD797 2',
            'subject_code' => 'SHKD797'
        ]);

        DB::table('modules')->insert([
            'name' => 'Triết học Marx-Lenin 1',
            'code' => 'SHKD797 3',
            'subject_code' => 'SHKD797'
        ]);

        DB::table('modules')->insert([
            'name' => 'Triết học Marx-Lenin 1',
            'code' => 'SHKD797 4',
            'subject_code' => 'SHKD797'
        ]);

        DB::table('modules')->insert([
            'name' => 'Triết học Marx-Lenin 2',
            'code' => 'MIAD961 1',
            'subject_code' => 'MIAD961'
        ]);

        DB::table('modules')->insert([
            'name' => 'Triết học Marx-Lenin 2',
            'code' => 'MIAD961 2',
            'subject_code' => 'MIAD961'
        ]);

        DB::table('modules')->insert([
            'name' => 'Triết học Marx-Lenin 2',
            'code' => 'MIAD961 3',
            'subject_code' => 'MIAD961'
        ]);

        DB::table('modules')->insert([
            'name' => 'Triết học Marx-Lenin 2',
            'code' => 'MIAD961 4',
            'subject_code' => 'MIAD961'
        ]);

        DB::table('modules')->insert([
            'name' => 'Các thiết bị mạng và môi trường truyền',
            'code' => 'HOKS042 1',
            'subject_code' => 'HOKS042'
        ]);

        DB::table('modules')->insert([
            'name' => 'Các thiết bị mạng và môi trường truyền',
            'code' => 'HOKS042 2',
            'subject_code' => 'HOKS042'
        ]);

        DB::table('modules')->insert([
            'name' => 'Mạng máy tính',
            'code' => 'HBAD267 1',
            'subject_code' => 'HBAD267'
        ]);
    }
}
