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
        // $this->call(UsersTableSeeder::class);
        DB::table('users')->truncate();
        DB::table('users')->insert([
          [
            'name' => 'user1',
            'email' => 'examreg@gmail.com',
            'password' => bcrypt(123456)
          ]
        ]);
    }
}
