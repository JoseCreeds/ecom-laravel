<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'user_status' => '',
            'password' => 'required|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'user_status' => '0',
            'password' => bcrypt($request->password)
        ]);

        $token = $user->createToken('myToken')->plainTextToken;
        $response = [
            'user' => $user,
            'myToken' => $token
        ];
        return response($response, 201);
    }

    // public function login(Request $request)
    // {
    //     $fields = $request->validate([
    //         'email' => 'required|string',
    //         'password' => 'required|string',
    //     ]);

    //     //Check email
    //     $user = User::where('email', $fields['email'])->first();
    //     //Check password
    //     if (!$user || !Hash::check($fields['password'], $user->password)) {
    //         return response([
    //             'message' => 'Bad credentials'
    //         ], 401);
    //     } else {

    //         $token = $user->createToken('myToken')->plainTextToken;

    //         $response = [
    //             'user' => $user,
    //             'myToken' => $token
    //         ];

    //         return response($response, 201);
    //         // cookie($response, 60)->
    //         // return redirect()->back();


    //     }
    // }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        //Check email
        // $user = User::where('email', $request['email'])->first();
        // //Check password
        // if (!$user || !Hash::check($request['password'], $user->password)) {
        //     return response([
        //         'message' => 'Bad credentials'
        //     ], 401);
        // } 

        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Bad credentials'
            ], 401);
        }

        $user = $request->user();
        $token = $user->createToken('myToken')->plainTextToken;

        $response = [
            'user' => $user,
            'myToken' => $token
        ];

        // return response($response, 201);
    return redirect()->route('home');

    }

    public function logout(Request $request)
    {
        // auth('sanctum')->
        auth('sanctum')->user()->tokens()->delete();

        return response([
            'message' => 'Logged out'
        ]);
    }
}
