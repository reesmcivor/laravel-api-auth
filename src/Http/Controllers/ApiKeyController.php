<?php

namespace ReesMcIvor\ApiAuth\Http\Controllers;

use App\Http\Controllers\Controller;

class ApiKeyController extends Controller
{
    public function check()
    {
        return response()->json([
            'message' => 'Successfully Logged in'
        ]);
    }
}
