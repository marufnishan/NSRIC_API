<?php

use App\Http\Controllers\Backend\ContuctController;
use App\Http\Controllers\Backend\SettingsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RolePermission\AllUserController;
use App\Http\Controllers\RolePermission\PermissionController;
use App\Http\Controllers\RolePermission\RolesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/login-form', function () {
    return view('auth.login');
})->name('api.login');
Route::get('/register-form', function () {
    return view('auth.register');
})->name('api.register');
Auth::routes();
Route::middleware('auth:api')->get('logout', function (Request $request) {
    DB::table('oauth_access_tokens')
        ->whereUserId($request->user()->id)
        ->delete();
    return $request->user();
})->name('api.logout');
Route::post('/user-login', 'App\Http\Controllers\UserController@login')->name('user.login');
Route::post('/user-register', 'App\Http\Controllers\UserController@register')->name('user.register');

Route::middleware('auth:web')->group( function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('/products-ajax-crud', ProductController::class);
    Route::post('/products-ajax-crud-update', [ProductController::class, 'update'])->name('products-ajax-crud-update');
    Route::delete('/products-ajax-crud-delete', [ProductController::class, 'destroy'])->name('products-ajax-crud-delete');
    Route::get('/pagination/paginate-data', [ProductController::class, 'pagination']);
    Route::get('/search-product', [ProductController::class, 'searchProduct'])->name('serach.product');
});


Route::middleware(['auth', 'role:Administrator'])->name('admin.')->prefix('admin')->group(function () {
    //Roles
    Route::resource('/roles', RolesController::class);
    Route::get('/search-role', [RolesController::class, 'searchrole'])->name('role.serach');
    Route::get('/pagination/paginate-role', [RolesController::class, 'pagination'])->name('role.paginate');
    //Permissions
    Route::resource('/permissions', PermissionController::class);
    Route::get('/search-permission', [PermissionController::class, 'searchpermission'])->name('permission.serach');
    Route::get('/pagination/paginate-permission', [PermissionController::class, 'pagination'])->name('permission.paginate');
    //Users
    Route::get('/users', [AllUserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [AllUserController::class, 'show'])->name('users.show');
    Route::get('/search-user', [AllUserController::class, 'searchuser'])->name('users.serach');
    Route::get('/pagination/paginate-user', [AllUserController::class, 'pagination'])->name('user.paginate');
    Route::delete('/users/{user}', [AllUserController::class, 'destroy'])->name('users.destroy');
    Route::get('/users/{user}', [AllUserController::class, 'show'])->name('users.show');
    Route::post('/users/{user}/roles', [AllUserController::class, 'assignRole'])->name('users.roles');
    Route::delete('/users/{user}/roles/{role}', [AllUserController::class, 'removeRole'])->name('users.roles.remove');
    Route::post('/users/{user}/permissions', [AllUserController::class, 'givePermission'])->name('users.permissions');
    Route::delete('/users/{user}/permissions/{permission}', [AllUserController::class, 'revokePermission'])->name('users.permissions.revoke');
    //Contuct Us
    Route::resource('contucts', ContuctController::class);
    Route::get('/search-contucts', [ContuctController::class, 'searchcontuct'])->name('contucts.serach');
    Route::get('/pagination/paginate-contucts', [ContuctController::class, 'pagination'])->name('contucts.paginate');
    //Settings
    Route::resource('settings', SettingsController::class);
    
});