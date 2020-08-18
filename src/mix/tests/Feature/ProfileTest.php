<?php

namespace Tests\Feature;

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
        // no_routeの処理（異常系）
        $response = $this->get('/no_route');
        $response->assertStatus(404);
        
        // ウェルカムページ表示
        $response = $this->get('/');
        $response->assertStatus(200);

        // ユーザプロフィール表示（異常）
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
            'introduction' => 'aaaaa',
            'profile_image' => 'aaaaa'
        ]);
        $response->assertStatus(302);
        $response->assertRedirect('/top');

        // 勉強会表示
        $meeting = factory(Meetings::class)->create();
        $user = User::find($meeting->user_id);
        $response = $this->actingAs($user)->get('/meeting');
        $response->assertStatus(200);

        // 勉強会登録画面表示
        $response = $this->actingAs($user)->get('/meeting_regist');
        $response->assertStatus(200);

        // 勉強会登録
        $response = $this->actingAs($user)->post('/meeting_regist', [
            'title' => 'aaaaa',
            'language' => 0,
            'area' => 1,
            'overview' => 'aaaaa',
            'meeting_image' => 'aaaaa'
        ]);
        $response->assertStatus(302);
        $response->assertRedirect('/meeting');
    }
}
