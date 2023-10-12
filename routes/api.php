<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\PlacesController;
use App\Http\Controllers\WebsiteController;

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
    Route::get('/get_parent_modules', [ModuleController::class, 'getParentModules']);
    Route::post('/add_module', [ModuleController::class, 'addModule']);
    Route::post('/update_module_status', [ModuleController::class, 'updateModuleStatus']);
    Route::post('/get_permission_wise_roles', [ModuleController::class, 'getPermissionWiseRoles']);
    Route::post('/save_module_permission_role_wise', [ModuleController::class, 'saveModulePermissionRoleWise']);
    //End Module

    //User crud
    Route::get('/get_all_users', [UserController::class, 'getAllUsers']);
    Route::post('/add_user', [UserController::class, 'addUser']);
    Route::get('/get_user_by_id/{id}', [UserController::class, 'getUserById']);
    Route::post('/update_user', [UserController::class, 'updateUser']);
    //End User

    //Module Permissions
    Route::post('/all_modules_with_permission', [ModuleController::class, 'getAllModulesWithPermission']);
    Route::post('/save_module_permissions', [ModuleController::class, 'saveModulePermissions']);
    //End Module Permissions

    //Places
    Route::get('/get_all_places', [PlacesController::class, 'getAllPlaces']);
    Route::post('/save_places', [PlacesController::class, 'savePlaces']);
    Route::post('/get_place_by_id', [PlacesController::class, 'getPlaceById']);
    Route::post('/update_places', [PlacesController::class, 'updatePlaces']);
    Route::post('/delete_place', [PlacesController::class, 'deletePlace']);

    Route::post('/get_amenities', [PlacesController::class, 'getAmenities']);
    //End Places

    Route::get('/get_roles', [GeneralController::class, 'getRoles']);

    Route::post('/user_logout', [AdminController::class, 'UserLogout']);

});

Route::post('/login_auth', [AdminController::class, 'loginAuth'])->name('login_auth');

//Api's for website

Route::post('/get_places', [WebsiteController::class, 'getPlaces']);