<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ModuleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    //role crud 
    Route::get('/get_all_roles', [RoleController::class, 'getAllRoles']);
    Route::post('/add_user_role', [RoleController::class, 'addUserRole']);
    //End Role

    //Module crud
    Route::get('/get_all_modules', [ModuleController::class, 'getAllModules']);
    Route::post('/add_module', [ModuleController::class, 'addModule']);
    Route::post('/update_module_status', [ModuleController::class, 'updateModuleStatus']);
    Route::post('/get_permission_wise_roles', [ModuleController::class, 'getPermissionWiseRoles']);

    //End Module
});

Route::post('/login_auth', [AdminController::class, 'loginAuth'])->name('login_auth');
