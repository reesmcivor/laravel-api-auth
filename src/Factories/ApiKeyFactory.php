<?php

namespace ReesMcIvor\ApiAuth\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use ReesMcIvor\ApiAuth\Models\ApiKey;

class ApiKeyFactory extends Factory
{
    protected $model = ApiKey::class;

    public function definition(): array
    {
        return [
            'key' => Str::random(40),
            'secret' => Str::random(40),
            'expires_at' => now()->addYear(),
        ];
    }
}
