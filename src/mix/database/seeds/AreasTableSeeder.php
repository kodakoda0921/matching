<?php

use Illuminate\Database\Seeder;
use App\Models\Areas;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //一括削除
        Areas::truncate();
        //登録
        Areas::create([
            'id' => 0,
            'area' => "東京" 
        ]);
        Areas::create([
            'id' => 1,
            'area' => "千葉" 
        ]);
        Areas::create([
            'id' => 2,
            'area' => "神奈川" 
        ]);
        Areas::create([
            'id' => 3,
            'area' => "埼玉" 
        ]);
        Areas::create([
            'id' => 4,
            'area' => "大阪" 
        ]);
    }
}
