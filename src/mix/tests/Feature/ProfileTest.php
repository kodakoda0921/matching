<?php

namespace Tests\Feature;

use App\Models\Areas;
use App\Models\Languages;
use App\Models\Meetings;
use App\Models\UserProfile;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    // データベースのマイグレーション
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testWeb()
    {
        factory(Areas::class)->create(['id' => 0]);
        factory(Areas::class)->create(['id' => 1]);
        factory(Areas::class)->create(['id' => 2]);
        factory(Areas::class)->create(['id' => 3]);
        factory(Areas::class)->create(['id' => 4]);
        factory(Languages::class)->create(['id' => 0]);
        factory(Languages::class)->create(['id' => 1]);
        factory(Languages::class)->create(['id' => 2]);
        factory(Languages::class)->create(['id' => 3]);
        factory(Languages::class)->create(['id' => 4]);
        // no_routeの処理（異常系）
        $response = $this->get('/no_route');
        $response->assertStatus(404);

        // ウェルカムページ表示
        $response = $this->get('/');
        $response->assertStatus(200);

        // ユーザプロフィール表示（異常系）
        $response = $this->get('/userProfile');
        $response->assertStatus(500);

        // ユーザプロフィール表示
        $userProfile = factory(UserProfile::class)->create();
        $user = User::find($userProfile->user_id);
        $response = $this->actingAs($user)->get('/userProfile');
        $response->assertStatus(200);

        // ユーザプロフィール更新
        $response = $this->actingAs($user)->post('/userProfile', [
            'sex' => 0,
            'language' => 0,
            'area' => 1,
            'introduction' => 'aaaaa'
        ]);
        $response->assertStatus(302);
        $response->assertRedirect('/top');

        // top表示
        $response = $this->actingAs($user)->get('/top');
        $response->assertStatus(200);

        // 検索画面表示
        $response = $this->actingAs($user)->get('/index');
        $response->assertStatus(200);

        // 勉強会表示
        $response = $this->actingAs($user)->get('/meeting');
        $response->assertStatus(200);

        // 勉強会登録画面表示
        $response = $this->actingAs($user)->get('/meeting_regist');
        $response->assertStatus(200);

        // 勉強会登録
        $response = $this->actingAs($user)->post('/meeting_regist', [
            'title' => 'aaaaa',
            'language' => 0,
            'area' => 0,
            'overview' => 'aaaaa',
            'event_date' => '2020-08-10',
        ]);
        $response->assertStatus(302);
        $response->assertRedirect('/meeting');
        $this->withoutExceptionHandling();
        // 勉強会詳細画面表示
        $response = $this->actingAs($user)->get('/meeting/view/'.'1');
        $response->assertStatus(200);
        
        // 勉強会更新画面表示
        $response = $this->actingAs($user)->get('/meeting/edit/'.'1');
        $response->assertStatus(200);

        // 勉強会更新画面表示
        $response = $this->actingAs($user)->post('/meeting/edit/'.'1', [
            'title' => 'aaaaa',
            'language' => 0,
            'area' => 1,
            'overview' => 'aaaaa',
            'event_date' => '2020-08-10',
        ]);
        $response->assertStatus(302);
        $response->assertRedirect('/meeting/view/'.'1');
    }
    
}
