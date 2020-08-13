<?php

use Illuminate\Database\Seeder;
use App\Models\Languages;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //一括削除
        Languages::truncate();
        //登録
        Languages::create([
            'id' => 0,
            'language' => "ruby" 
        ]);
        Languages::create([
            'id' => 1,
            'language' => "python" 
        ]);
        Languages::create([
            'id' => 2,
            'language' => "php" 
        ]);
        Languages::create([
            'id' => 3,
            'language' => "golang" 
        ]);
        Languages::create([
            'id' => 4,
            'language' => "swift" 
        ]);
    }
}
