<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class GeneralController extends Controller
{
    public function getRoles()
    {
        $Roles = Role::select(['id as value', 'name as label'])->get();

       return response()->json([
            'status' => true,
            'message' => '',
            'data' => $Roles
        ], 200);
    }
}
