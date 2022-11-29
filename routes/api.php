<?php

use App\Http\Controllers\Api\ForgotPasswordController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\ContuctController;
use App\Http\Controllers\DevisionController;
use App\Http\Controllers\DevisionUnitController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SliderController;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\API\RegisterController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register', 'App\Http\Controllers\API\RegisterController@register');
Route::post('login', 'App\Http\Controllers\API\RegisterController@login')->name('admin.login');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password');
/* Route::post('reset', 'App\Http\Controllers\API\RegisterController@passwordReset')->name('admin.reset'); */
Route::middleware('auth:api')->group( function () {
    Route::resource('products', 'App\Http\Controllers\API\ProductController');
    Route::resource('roles', RoleController::class);
    Route::resource('sliders', SliderController::class);
    Route::resource('settings', SettingController::class);
    Route::resource('contuct', ContuctController::class);
    Route::resource('devisions', DevisionController::class);
    Route::resource('devision_units', DevisionUnitController::class);
    Route::get('logout', 'App\Http\Controllers\API\RegisterController@logout')->name('admin.logout');
});
/* Route::middleware('auth:api')->get('logout', function (Request $request) {
    DB::table('oauth_access_tokens')
        ->whereUserId($request->user()->id)
        ->delete();
    return $request->user();
}); */