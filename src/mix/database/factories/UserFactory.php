<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Areas;
use App\Models\Languages;
use App\Models\Meetings;
use App\Models\UserProfile;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});
$factory->define(UserProfile::class, function (Faker $faker) {
    return [
        'user_id' => function(){
            //UserProfileインスタンスを作成する際に、リレーションするUserインスタンスも生成する
            return factory(User::class)->create()->id;
        },
        'sex' => $faker->randomElement([0, 1, 2]),
        'picture' => 'CY5lSgbKGGq6woNq4zPsz8w1eT3QdyGEL9F9T0ba.jpeg',
        'language' => $faker->randomElement([0, 1, 2, 3, 4]),
        'introduction' => $faker->realText(100),
        'area' =>  $faker->randomElement([0, 1, 2, 3, 4]),
        'update_timestamp' => $faker->dateTimeBetween('-1 days', '1 days')->format('Y-m-d H:i')
    ];
});
$factory->define(Meetings::class, function (Faker $faker) {
    return [
        'user_id' => function(){
            //UserProfileインスタンスを作成する際に、リレーションするUserインスタンスも生成する
            return factory(User::class)->create()->id;
        },
        'title' => $faker->text(10),
        'picture' => null,
        'language' => $faker->randomElement([0, 1, 2, 3, 4]),
        'area' =>  $faker->randomElement([0, 1, 2, 3, 4]),
        'overview' => $faker->realText(100),
        'event_date' => $faker->dateTimeBetween('-1 days', '1 days')->format('Y-m-d'),

    ];
});
$factory->define(Languages::class, function (Faker $faker) {
    return [
        'language' => "ruby"
    ];
});
$factory->define(Areas::class, function () {
    return [
        'area' => "東京"
    ];
});

