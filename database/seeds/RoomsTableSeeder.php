<?php

//use App\Models\Room;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rooms')->truncate();
//        factory(Room::class, 10)->create();

        DB::table('rooms')->insert([
            'name' => '201-G2',
            'capacity' => '40'
        ]);

        DB::table('rooms')->insert([
            'name' => '202-G2',
            'capacity' => '40'
        ]);

        DB::table('rooms')->insert([
            'name' => '207-G2',
            'capacity' => '40'
        ]);

        DB::table('rooms')->insert([
            'name' => '208-G2',
            'capacity' => '40'
        ]);

        DB::table('rooms')->insert([
            'name' => 'A Zone - Vikings CyberCafe Khâm Thiên',
            'capacity' => '50'
        ]);

        DB::table('rooms')->insert([
            'name' => 'B Zone - Vikings CyberCafe Khâm Thiên',
            'capacity' => '50'
        ]);

        DB::table('rooms')->insert([
            'name' => 'H Zone - Vikings CyberCafe Khâm Thiên',
            'capacity' => '50'
        ]);

        DB::table('rooms')->insert([
            'name' => 'P Zone - Vikings CyberCafe Khâm Thiên',
            'capacity' => '50'
        ]);

        DB::table('rooms')->insert([
            'name' => 'Z Zone - Vikings CyberCafe Khâm Thiên',
            'capacity' => '50'
        ]);

        DB::table('rooms')->insert([
            'name' => 'Esports Zone - Vikings CyberCafe Khâm Thiên',
            'capacity' => '20'
        ]);

        DB::table('rooms')->insert([
            'name' => 'Stream Zone - Vikings CyberCafe Khâm Thiên',
            'capacity' => '10'
        ]);

        DB::table('rooms')->insert([
            'name' => 'A Zone - Vikings CyberCafe Thành Thái',
            'capacity' => '50'
        ]);

        DB::table('rooms')->insert([
            'name' => 'B Zone - Vikings CyberCafe Thành Thái',
            'capacity' => '50'
        ]);

        DB::table('rooms')->insert([
            'name' => 'L Zone - Vikings CyberCafe Thành Thái',
            'capacity' => '50'
        ]);

        DB::table('rooms')->insert([
            'name' => 'P Zone - Vikings CyberCafe Thành Thái',
            'capacity' => '50'
        ]);

        DB::table('rooms')->insert([
            'name' => 'S Zone - Vikings CyberCafe Thành Thái',
            'capacity' => '50'
        ]);

        DB::table('rooms')->insert([
            'name' => 'Esports Zone - Vikings CyberCafe Thành Thái',
            'capacity' => '20'
        ]);

        DB::table('rooms')->insert([
            'name' => 'A Zone - Vikings Esports Arena Hà Đông',
            'capacity' => '50'
        ]);

        DB::table('rooms')->insert([
            'name' => 'B Zone - Vikings Esports Arena Hà Đông',
            'capacity' => '50'
        ]);

        DB::table('rooms')->insert([
            'name' => 'P Zone - Vikings Esports Arena Hà Đông',
            'capacity' => '50'
        ]);

        DB::table('rooms')->insert([
            'name' => 'Esports Zone - Vikings Esports Arena Hà Đông',
            'capacity' => '20'
        ]);

        DB::table('rooms')->insert([
            'name' => 'Stream Zone - Vikings Esports Arena Hà Đông',
            'capacity' => '10'
        ]);
    }
}
