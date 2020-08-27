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
        $this->call(UsersTableSeeder::class);
        $this->call(UserProfileTableSeeder::class);
        $this->call(AreasTableSeeder::class);
        $this->call(LanguagesTableSeeder::class);
        $this->call(MeetingsTableSeeder::class);
        $this->call(JoinsTableSeeder::class);
    }
}
