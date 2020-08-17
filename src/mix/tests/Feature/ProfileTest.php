<?php

namespace Tests\Feature;

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
        $response = $this->get('/');
        $response->assertStatus(200);

        $response = $this->get('/userProfile');
        $response->assertStatus(500);

        $userProfile = factory(UserProfile::class)->create();
        $user = User::find($userProfile->user_id);
        $response = $this->actingAs($user)->get('/userProfile');
        $response->assertStatus(200);

        $response = $this->get('/no_route');
        $response->assertStatus(404);
    }
}
