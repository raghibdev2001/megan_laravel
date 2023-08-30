<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;

class ModuleController extends Controller
{
    public function addModule(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:modules'
        ]);

        $data = [
            'name' => $request->name,
            'is_enabled' => 1
        ];

        $module = Module::create($data);

        if($module)
        {
            return response()->json([
                'status' => true,
                'message' => 'Role created successfully',
                'data' => []
            ], 200);
        }
        else
        {
            return response()->json([
                'status' => false,
                'message' => 'Sorry! failed to create role',
                'data' => []
            ], 401);
        }
    }
}
