<?php

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Request;
// use Illuminate\Routing\Route;

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
Route::post('/postproperty', 'API\PropertyPostController@createPropertyPost');
// Route::get('getdata', 'API\PropertyPostController@index');

// Route::get('show/{id}', 'API\PropertyPostController@show');
Route::post('hide/{id}', 'API\PropertyPostController@deletePost');

Route::post('viewhistorypost', 'API\PropertyPostController@viewPropertyPostHistory');

Route::post('search', 'API\PropertyPostController@searchProperty');

Route::post('analyze', 'API\PropertyPostController@analyzeProperty');

Route::post('viewpost', 'API\PropertyPostController@viewPropertyList');

Route::post('viewpostdetial', 'API\PropertyPostController@viewPropertyPostDetial');

Route::post('notification', 'API\NotificationPropertyController@viewNotification');

Route::post('update/{id}', 'API\PropertyPostController@editPropertyPost');

Route::post('district', 'API\DistrictController@getDistrict');

Route::post('createUser', 'API\UserController@createUser');

Route::post('updateUser/{token}', 'API\UserController@updateUser');
Route::post('test', 'API\UserController@test');
Route::post('upload', 'API\UserController@upload');

Route::post('viewdetial', 'API\PropertyPostController@viewDetial');

Route::post('notification', 'API\NotificationPropertyController@sendNotification');
Route::post('device', 'API\NotificationPropertyController@createUserTokenDevice');
Route::post('checkPostUser', 'API\UserController@checkOwnPostUser');

Route::post('deletimage', 'API\PropertyPostController@deleteImage');
Route::post('payment', 'API\PaymentController@bongloy');
Route::post('paid', 'API\PropertyPostController@paid');

