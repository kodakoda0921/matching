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
                'user_id' => $i,
                'sex' => $faker->randomElement([0, 1, 2]),
                'picture' => null,
                'language' => $faker->randomElement([0, 1, 2, 3, 4]),
                'introduction' => $faker->realText(100),
                'area' =>  $faker->randomElement([0, 1, 2, 3, 4]),
                'update_timestamp' => $faker->dateTimeBetween('-1 days', '1 days')->format('Y-m-d H:i')
            ]);
        }
        UserProfile::create([
            'id' => 10,
            'user_id' => 10,
            'sex' => $faker->randomElement([0, 1, 2]),
            'picture' => null,
            'language' => $faker->randomElement([0, 1, 2, 3, 4]),
            'introduction' => "こんにちは！ポートフォリオサイトへアクセスしてくださりありがとうございます！",
            'area' =>  $faker->randomElement([0, 1, 2, 3, 4]),
            'update_timestamp' => $faker->dateTimeBetween('-1 days', '1 days')->format('Y-m-d H:i')
        ]);
    }
}
