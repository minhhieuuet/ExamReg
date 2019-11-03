<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(StudentsTableSeeder::class);
        DB::table('users')->truncate();
        DB::table('users')->insert([
          [
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt(123456)
          ]
        ]);
    }
}
