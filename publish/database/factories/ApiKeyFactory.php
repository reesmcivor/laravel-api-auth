<?php

namespace ReesMcIvor\ApiAuth\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use ReesMcIvor\ApiAuth\Models\ApiKey;

class ApiKeyFactory extends Factory
{
    protected $model = ApiKey::class;

    public function definition(): array
    {
        return [
            'key' => Str::Str::random(40),
            'secret' => Str::Str::random(40),
        ];
    }
}
