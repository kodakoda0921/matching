<?php

use Illuminate\Database\Seeder;
use App\Models\Joins;

class JoinsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //一括削除
        Joins::truncate();
        $faker = Faker\Factory::create('ja_JP');
        for ($i = 1; $i < 10; $i++) {
            Joins::create([
                'id' => $i,
                'user_id' => $faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9]),
                'meeting_id' => $faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9]),
                'approval' => $faker->randomElement([0, 1, 2]),
                'update_timestamp' => $faker->dateTimeBetween('-1 days', '1 days')->format('Y-m-d H:i')
            ]);
        }
    }
}
