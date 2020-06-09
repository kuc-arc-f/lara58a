<?php

use Illuminate\Http\Request;

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
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//
Route::middleware(['cors'])->group(function () {
    //tasks
    Route::get('test_tasks', 'ApiTasksController@test_tasks');
    Route::get('cross_task/get_tasks', 'ApiCrosTasksController@get_tasks');
    Route::options('cross_task/create_task', function () {
        return response()->json();
    });
    Route::post('cross_task/create_task', 'ApiCrosTasksController@create_task');
    Route::options('cross_task/get_item', function () {
        return response()->json();
    });
    Route::post('cross_task/get_item', 'ApiCrosTasksController@get_item');
    Route::options('cross_task/update_post', function () {
        return response()->json();
    });
    Route::post('cross_task/update_post', 'ApiCrosTasksController@update_post');
    Route::options('cross_task/delete_task', function () {
        return response()->json();
    });
    Route::post('cross_task/delete_task', 'ApiCrosTasksController@delete_task');

});