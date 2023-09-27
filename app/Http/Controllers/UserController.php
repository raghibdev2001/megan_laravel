<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RoleUser;
use Validator;

class UserController extends Controller
{
    public function getAllUsers()
    {
       $Users = User::select(['id', 'name', 'created_at', 'updated_at'])->get();

       return response()->json([
            'status' => true,
            'message' => '',
            'data' => $Users
        ]);
    }

    public function addUser(Request $request)
    {
        
        $validator = Validator::make($request->all(), [ 
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'user_role' => 'required'
        ]);

        if ($validator->fails()) { 
            return response()->json([
                'status' => false,
                'message' => 'Sorry! failed to create user',
                'data' => [],
                'errors'=> $validator->errors()
            ]);  
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ];

        
        $User = User::create($data);

        if($User)
        {
            $RoleId = $request->user_role['value'];
            $User->Roles()->attach($RoleId);
            
            return response()->json([
                'status' => true,
                'message' => 'User created successfully',
                'data' => [],
                'errors'=> []
                
            ]);
        }
        else
        {
            return response()->json([
                'status' => false,
                'message' => 'Sorry! failed to create user',
                'data' => [],
                'errors'=> ['error_message'=>"Sorry! failed to create user"]
            ]);
        }
    }

    public function getUserById($id)
    {
        $user = User::find($id);
        
        $data = [
            'id'=>$user->id,
            'name'=>$user->name,
            'email'=>$user->email,
            'roles'=>$user->Roles->toArray()
        ];

        return response()->json([
            'status' => true,
            'message' => '',
            'data' => $data,
            'errors'=> []
            
        ]);
    }

    public function updateUser(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$request->id,
        ]);

        if ($validator->fails()) { 
            return response()->json([
                'status' => false,
                'message' => 'Sorry! failed to create user',
                'data' => [],
                'errors'=> $validator->errors()
            ]);  
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];


        $User = User::find($request->id);
        $Result = $User->update($data);

        if($Result)
        {
            if($request->user_role)
            {
                RoleUser::where(['user_id'=>$request->id])->delete();
                $RoleId = $request->user_role['value'];
                $User->Roles()->attach($RoleId);
            }
            

            return response()->json([
                'status' => true,
                'message' => 'User updated successfully',
                'data' => [],
                'errors'=> []
                
            ]);
        }
        else
        {
            return response()->json([
                'status' => false,
                'message' => 'Sorry! failed to update user',
                'data' => [],
                'errors'=> ['error_message'=>"Sorry! failed to update user"]
            ]);
        }
    }
}
