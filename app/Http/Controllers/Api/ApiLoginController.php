<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ApiLoginController extends Controller
{
    public function api_login()
    {
        $user = User::get();
        return response()->json($user);
    }
}
