<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function checkEmailExists(Request $request)
    {
        $email = $request->email;
        $userExists = User::where('email', $email)->exists();
        return response()->json(['exists' => $userExists]);
    }

    public function createUser(Request $request)
    {
        // * create user
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'image' => $request->input('image'),
            'date_of_birth' => $request->input('date_of_birth'),
        ]);

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'data' => [
                'user' => $user,
                'token' => $token,
            ]
        ], 201);
    }

    public function login(Request $request)
    {
        // * validate
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // * otentikasi
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], )) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;
            $id = $user->id;
            $name = $user->name;
            $image = $user->image;
            $user_id = $user->id;

            // * return response json
            return response()->json([
                'data' => [
                    'user' => $user,
                    'token' => $token,
                    'id' => $id,
                    'user_id' => $user_id,
                    'name' => $name,
                    'image' => $image,
                ],
            ], 200);
        } else {
            return response()->json([
                "error" => "Maaf, Email atau Password salah!"
            ]);
        }
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        // * hapus token
        $user->tokens()->delete();
        return response()->json(['message' => "Logged out succesfully"], 200);
    }
}
