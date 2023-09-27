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
                'user' => $user,
                'user_role' => $user->Roles[0]['name']
            );

            return response()->json([
                'status' => true,
                'message' => 'Login successful',
                'data' => $data
            ]);
        }
        

        return response()->json([
            'status' => false,
            'message' => 'Invalid user credentials',
            'data' => []
        ]);
    }

    public function UserLogout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Logout successful',
            'data' => []
        ]);
    }
}
