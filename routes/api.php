<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


/*
|--------------------------------------------------------------------------
| 修改env API
|--------------------------------------------------------------------------
*/
//檢視env清單資料
Route::get('env_list', 'EditENVController@getContent');
//檢視env單一資料
Route::get('env_list/{key}', 'EditENVController@getKeys');
//檢視env單一資料的值
Route::get('env_list_value/{key}', 'EditENVController@getValue');
//新增 env 資料
Route::post('env_new', 'EditENVController@store');
//修改 env 資料
Route::put('env_edit', 'EditENVController@update');
//刪除 env 資料
Route::delete('env_del', 'EditENVController@delete');

//備份
Route::post('backup', 'EditENVController@backup');
//取得全部備份
Route::get('getBackups', 'EditENVController@getBackups');
//取得最後一次備份
Route::get('getLatestBackup', 'EditENVController@getLatestBackup');
//刪除備份
Route::delete('deleteBackups', 'EditENVController@deleteBackups');
//開啟/關閉 自動關閉
Route::post('autoBackup', 'EditENVController@autoBackup');

//還原最後一次備份
Route::post('restore', 'EditENVController@restore');