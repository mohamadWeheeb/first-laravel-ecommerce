<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class LoginController extends Controller
{


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required' ,
            'password' => 'required' ,
            'device'    =>  ''
        ]);

        $user = User::where('email' , '=' , $request->email)->first();
        if($user && Hash::check($request->password , $user->password))
        {
            $device = $request->input('device' , $request->userAgent());
            $token = $user->createToken($device , ['products.create' , 'products.update']);
            return Response::json([
                "token" =>  $token->plainTextToken,
            ]);
        }
        return Response::json([
            "message" => " Invalid E-mail and Password Combination ! " ,

        ] , 401);
    }
}
