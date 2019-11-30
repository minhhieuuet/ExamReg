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
        DB::table('users')->truncate();
        DB::table('users')->insert([
          [
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt(123456),
            'role' => 2
          ]
        ]);
        factory(App\User::class, 50)->create();

        $this->call(ModulesTableSeeder::class);
        $this->call(RoomsTableSeeder::class);
        $this->call(UniversitiesTableSeeder::class);
    }
}
