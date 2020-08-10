<?php

use Illuminate\Database\Seeder;
use App\Models\UserProfile;

class UserProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //一括削除
        UserProfile::truncate();
        //登録
        $faker = Faker\Factory::create('ja_JP');
        for ($i = 1; $i < 10; $i++) {
            UserProfile::create([
                'id' => $i,
                'singer' => $faker->randomElement([true, false]),
                'mixer' => $faker->randomElement([true, false]),
                'update_timestamp' => $faker->dateTimeBetween('-1 days', '1 days')->format('Y-m-d H:i'),
            ]);
        }
    }
}
