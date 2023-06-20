<?php

namespace ReesMcIvor\ApiAuth\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use ReesMcIvor\AuthApi\Database\Factories\ApiKeyFactory;

class ApiKey extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected static function newFactory()
    {
        return ApiKeyFactory::new();
    }

}