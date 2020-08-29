<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //一括削除
        User::truncate();
        //登録
        $faker = Faker\Factory::create('ja_JP');
        for($i = 1; $i < 10; $i++){
            User::create([
                'id' => $i,
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make(str_pad($i, 10, '0', STR_PAD_LEFT)),
                'remember_token' => Str::random(10),
                'email_verified_at' => $faker->dateTimeBetween('-1 days', '1 days')->format('Y-m-d'),
            ]);
        }
        User::create([
            'id' => 10,
            'name' => "テストユーザ",
            'email' => "11111111@gmail.com",
            'password' => Hash::make("11111111"),
            'remember_token' => Str::random(10),
            'email_verified_at' => $faker->dateTimeBetween('-1 days', '1 days')->format('Y-m-d'),
        ]);

    }
}
