<?php

use App\Models\University;
use Illuminate\Database\Seeder;

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
        factory(University::class, 10)->create();
    }
}
