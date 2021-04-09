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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
    // return $request->user();
// });

Route::apiResource('registrations', 'Api\RegistrationsController')->only(['index']);

Route::get('test', function() {
	return [
		'test' => 'value'
	];
});

Route::post('integrity-server', function() {

	return [
		'token' => 'jwt-tokennn',
		'user' => [
			'id' => 1,
			'email' => 'admin@admin.com',
			'name' => 'Firstname Secondname',
		],
		'pemissions' => [
			'viewRegistration' => true
		]
	];
});