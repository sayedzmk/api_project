<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\User;

class AuthController extends Controller
{
    public function register(Request $request){
        $fileds=$request->validate([
            "name"=>"required|string",
            "email"=>"required|string|unique:users,email",
            "password"=>"required|string|confirmed"
        ]);
        $user=User::create([
            "name"=>$fileds['name'],
            "email"=>$fileds['email'],
            "password"=>bcrypt($fileds['password']),
        ]);
        $token=$user->createToken("userToken")->plainTextToken;
        $response=[
            "user"=>$user,
            "User Token"=>$token
        ];
        return response($response,201);
    }
    public function login(Request $request){
        $fileds=$request->validate([
            "email"=>"required|string",
            "password"=>"required|string"
        ]);
        $user=User::where("email",$fileds['email'])->first();
        if(!$user || !Hash::check($fileds['password'], $user->password)){
            return response([
                "message"=>"incorrect Password|Eamil"
            ],401);
        }
        $token=$user->createToken("userToken")->plainTextToken;
        $response=[
            "user"=>$user,
            "User Token"=>$token
        ];
        return response($response,201);
    }
    public function logout(Request $request){
        auth()->user()->tokens()->delete();
        return [
            "message"=>"Logout Done"
        ];
    }
}
