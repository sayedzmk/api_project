<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;
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
//public route
Route::get('getAllDataEmployee', "EmployeeController@index");
Route::get('shoeDataEmployee', "EmployeeController@show");
Route::post('register',"AuthController@register");
Route::post('login',"AuthController@login");

//Private route
Route::group(['middleware'=>["auth:sanctum"]],function(){

    Route::post('storeDataEmployee',"EmployeeController@store");
    Route::put('updateDataEmployee/{id}',"EmployeeController@update");
    Route::delete('deleteDataEmployee/{id}',"EmployeeController@destroy");
    Route::post('logout',"AuthController@logout");
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
