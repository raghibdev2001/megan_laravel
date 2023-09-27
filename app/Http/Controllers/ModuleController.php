<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\Role;
use App\Models\ModulePermission;
use Validator;


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

    public function getParentModules()
    {
        $Modules = Module::where('parent_id', '0')->orderBy('id','DESC')->get();

        return response()->json([
            'status' => true,
            'message' => '',
            'data' => $Modules
        ], 200);
    }

    public function addModule(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:modules',
        ]);

        $data = [
            'name' => $request->name,
            'path' => $request->path??"",
            'parent_id' => $request->parent_id??'0',
            'is_enabled' => 1
        ];

        $module = Module::create($data);

        if($module)
        {
            return response()->json([
                'status' => true,
                'message' => 'Module created successfully',
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
        $ModuleDetails = Module::where('id',$moduleId)->get(['id','name']);
        
        $data = array("module_name" => "", "role_data" => []);
        if($ModuleDetails)
        {
            $data['module_name'] = $ModuleDetails[0]['name'];
            $data['module_id'] = $ModuleDetails[0]['id'];
        }

        $RoleData = Role::select(['id as value','name as label'])->get();
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

    public function saveModulePermissionRoleWise(Request $request)
    {
        $ModuleDetails = $request->moduleDetails;
        $PermissionWiseRoles = $request->permissionWiseRoles;

        $AssignPermissionToRole = [];
        foreach($PermissionWiseRoles as $key => $PermissionRole)
        {
            foreach($PermissionRole as $Roles)
            {
                if( !isset($AssignPermissionToRole[$Roles['value']]) )
                {
                    $AssignPermissionToRole[$Roles['value']] = [
                        'module_id' => $ModuleDetails['id'],
                        'role_id'   => $Roles['value'],
                        'created_at' => date('Y-m-d H:i:s'),
                        'add' => 0,
                        'update' => 0,
                        'view' => 0,
                        'delete' => 0,
                    ];
                }
                
                if($key == 'add')
                {
                    $AssignPermissionToRole[$Roles['value']]['add'] = 1;
                }
                if($key == 'update')
                {
                    $AssignPermissionToRole[$Roles['value']]['update'] = 1;
                }
                if($key == 'view')
                {
                    $AssignPermissionToRole[$Roles['value']]['view'] = 1;
                }
                if($key == 'delete')
                {
                    $AssignPermissionToRole[$Roles['value']]['delete'] = 1;
                }
            }
        }

        if(!$AssignPermissionToRole)
        {
            return response()->json([
                'status' => false,
                'message' => 'Sorry! permissions not found',
                'data' => []
            ], 401);
        }

        $data = array_values($AssignPermissionToRole);
        
        $result = ModulePermission::insert($data);
        
        if($result)
        {
            return response()->json([
                'status' => true,
                'message' => 'Permissions are added successfully',
                'data' => []
            ], 200);
        }
        else
        {
            return response()->json([
                'status' => false,
                'message' => 'Sorry! Failed to add permissions',
                'data' => []
            ], 401);
        }
    }


    public function getAllModulesWithPermission(Request $request)
    {
        $RoleId = $request->role_id;
        
        $Modules = Module::select('id','name')->get()->toArray();
        $ModulePermissions = ModulePermission::select('id','module_id','add','update','view','delete')->where('role_id', $RoleId)->get()->toArray();
         
        $data = [];
        foreach ($Modules as $key => $Module)
        {
            $data[$key] = [
                'id' => $Module['id'],
                'name' => $Module['name'],
                'permission' => [
                    'add'    => 0,
                    'update' => 0,
                    'view'   => 0,
                    'delete' => 0,
                ]
            ];

            foreach ($ModulePermissions as $Permission)
            {
                if($Module['id'] == $Permission['module_id'])
                {
                    $data[$key]['permission'] = [
                        'add'    => $Permission['add'],
                        'update' => $Permission['update'],
                        'view'   => $Permission['view'],
                        'delete' => $Permission['delete'],
                    ];
                }
            }
        }
        
        return response()->json([
            'status' => true,
            'message' => 'Permissions are added successfully',
            'data' => $data
        ], 200);
        
    }

    public function saveModulePermissions(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'role_id' => 'required|not_in:0',
            'module_permissions' => 'required',
        ]);

        if ($validator->fails()) { 
            return response()->json([
                'status' => false,
                'message' => 'Sorry! failed to create user',
                'data' => [],
                'errors'=> $validator->errors()
            ],401);  
        }

        $RoleId = $request->role_id;
        $ModulePermissions = $request->module_permissions;

        $data = [];
        foreach ($ModulePermissions as $Permissions)
        {
            $data[] = [
                'role_id'   => $RoleId,
                'module_id' => $Permissions['module_id'],
                'add'       => $Permissions['permission']['add'],
                'update'    => $Permissions['permission']['update'],
                'view'      => $Permissions['permission']['view'],
                'delete'    => $Permissions['permission']['delete'],
                'created_at' => date('Y-m-d H:i:s') 
            ];
        }

        ModulePermission::where('role_id', $RoleId)->delete();

        $result = ModulePermission::insert($data);
        
        if($result)
        {
            return response()->json([
                'status' => true,
                'message' => 'Permissions are added successfully',
                'data' => [],
                'errors'=> []
            ], 200);
        }
        else
        {
            return response()->json([
                'status' => false,
                'message' => 'Sorry! Failed to add permissions',
                'data' => [],
                'errors'=> []
            ], 401);
        }
    }
}
