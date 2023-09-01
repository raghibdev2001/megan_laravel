<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\Role;


class ModuleController extends Controller
{

    public function getAllModules()
    {
        $Modules = Module::orderBy('id','DESC')->get();

        return response()->json([
            'status' => true,
            'message' => '',
            'data' => $Modules
        ], 200);
    }

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

    public function updateModuleStatus(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'is_enabled' => 'required'
        ]);

        $id =  $request->id;
        $is_enabled = $request->is_enabled== true? 1:0;

        $Module = Module::find($id);
        $Module->is_enabled = $is_enabled;
        $result = $Module->save();

        if($result)
        {
            return response()->json([
                'status' => true,
                'message' => 'Status updated successfully',
                'data' => []
            ], 200);
        }
        else
        {
            return response()->json([
                'status' => false,
                'message' => 'Failed to update module status',
                'data' => []
            ], 401);
        }
    }

    public function getPermissionWiseRoles(Request $request)
    {
        $moduleId = $request->id?? 0;
        $ModuleDetails = Module::where('id',$moduleId)->get(['name']);
        
        $data = array("module_name" => "", "role_data" => []);
        if($ModuleDetails)
        {
            $data['module_name'] = $ModuleDetails[0]['name'];
        }

        $RoleData = Role::select(['id','name'])->get();
        if($RoleData)
        {
            $data['role_data'] = $RoleData;
        }

        return response()->json([
            'status' => true,
            'message' => '',
            'data' => $data
        ], 200);
    }

}
