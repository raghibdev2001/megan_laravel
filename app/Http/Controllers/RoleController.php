<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function getAllRoles()
    {
        $UserRoles = Role::orderBy('id','DESC')->get();

        return response()->json([
            'status' => true,
            'message' => '',
            'data' => $UserRoles
        ], 200);
    }

    public function addUserRole(Request $request)
    {
        $request->validate([
            'roleName'=> 'required'
        ]);

        $data = [
            'name' => $request->roleName
        ];

        $role = Role::create($data);
        
        return response()->json([
            'status' => true,
            'message' => 'Role created successfully',
            'data' => []
        ], 200);
    }
}
