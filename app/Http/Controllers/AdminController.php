<?php

namespace App\Http\Controllers;

use Illuminate\Database\Console\Migrations\StatusCommand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //

    public function index()
    {
        return view('auth/login');

    }

    public function loginAuth(Request $request)
    {
        $request->validate([
            'email'=> 'required',
            'password' =>'required'
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            $data = array(
                'token' => $user->createToken('access_token')->plainTextToken,
                'user' => $user
            );

            return response()->json([
                'status' => true,
                'message' => 'Login successful',
                'data' => $data
            ], 200);
        }
        

        return response()->json([
            'status' => false,
            'message' => 'Invalid credentials',
            'data' => []
        ], 401);
    }

}
