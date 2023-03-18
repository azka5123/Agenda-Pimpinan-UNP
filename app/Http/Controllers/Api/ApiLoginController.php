<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiLoginController extends Controller
{
    public function api_login(Request $request)
    {
        // $user = User::where('id',1)->get();
        // return response()->json($user);
        $login = Auth::Attempt($request->all());
        if ($login) {
            $user = Auth::user();
            return response()->json([
                'response_code' => 200,
                'message' => 'Login Berhasil',
                'content' => $user
            ]);
        }else{
            return response()->json([
                'response_code' => 404,
                'message' => 'Username atau Password Tidak Ditemukan!'
            ]);
        }
    }


}