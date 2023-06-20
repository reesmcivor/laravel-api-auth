<?php

namespace Tests\AuthApi\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\Test;
use ReesMcIvor\ApiAuth\Models\ApiKey;
use Tests\TestCase;

class AuthApiTest extends TestCase {

    use RefreshDatabase;

    #[Test]
    public function a_token_can_be_used_to_login()
    {
        $apiKey = ApiKey::factory()->create();
        $headers = [ 'x-api-key' => $apiKey->key, 'x-api-secret' => $apiKey->secret ];
        $this->withHeaders($headers)->post('/api/check')->assertSuccessful()->assertJson([
            'message' => 'Successfully Logged in'
        ]);
    }

    #[Test]
    public function a_invalid_token_will_not_be_allowed()
    {
        $headers = ['x-api-key' => Str::random(40), 'x-api-secret' => Str::random(40)];
        $this->withHeaders($headers)->post('/api/check')->assertStatus(401)->assertJson([
            'error' => 'Invalid API keys'
        ]);
    }

    #[Test]
    public function a_expired_api_key_returns_401()
    {
        $apiKey = ApiKey::factory()->create(['expires_at' => now()->subDay()]);
        $headers = [ 'x-api-key' => $apiKey->key, 'x-api-secret' => $apiKey->secret ];
        $this->withHeaders($headers)->post('/api/check')->assertStatus(401)->assertJson([
            'error' => 'Invalid API keys'
        ]);
    }

    #[Test]
    public function a_api_key_can_be_created_through_command()
    {
        $apiKeys = $this->artisan("api-auth:create")
            ->assertExitCode(0)
            ->assertSuccessful();
    }

}
