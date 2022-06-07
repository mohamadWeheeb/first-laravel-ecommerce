<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class LogoutController extends Controller
{

    public function logoutFromCurrentDevice(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        $user->currentAccessToken()->delete();


        return Response::json([
            "message" => " You are Loged Out ! " ,

        ] );
    }


    public function logoutFromAllDevices()
    {
        $user = Auth::guard('sanctum')->user();
        $user->tokens()->delete();

        return Response::json([
            "message" => " You are Loged Out From All Devices ! " ,

        ] );
    }
}
