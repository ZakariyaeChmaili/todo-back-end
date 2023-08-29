<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        return User::create([
            "username" => $request->username,
            "password" => Hash::make($request->password)

        ]);
    }


    public function login(Request $request)
    {

       $user= User::where('username' , $request->username)->first();
        if($user){
            if(Hash::check($request->password,$user->password)){
                return response()->json(
                    [
                        'token' => $user->createToken($request->username)->plainTextToken,
                    ]
                    );
            }
        }

            return response()->json([
                "msg" => "Invalid credentials"
            ], 401);
        
    }


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }
}
