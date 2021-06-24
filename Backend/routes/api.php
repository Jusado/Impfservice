<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;


use App\Models\Image;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

//Route::get('events', [EventController::class,'index']);
//Route::get('events/{id}', [EventController::class,'findByID']);
Route::get('events/enumerationFreeDates', [EventController::class,'enumerationFreeDates']);

Route::get('events/enumeration', [EventController::class,'enumeration']);
Route::get('locations', [EventController::class,'getLocations']);

Route::post('auth/login', [AuthController::class, 'login']);
// methods which need authentication - JWT Token


Route::get('events/byId/{id}', [EventController::class, 'findByID']);








// Nur eingeloggte User
Route::group(['middleware' => ['api','cors', 'auth.jwt']], function() {
    Route::post('auth/logout', [AuthController::class, 'logout']);
    Route::post('events/book/{id}', [EventController::class, 'bookEvent']);
    Route::get('events/info', [EventController::class, 'getInfo']);
});

// Nur Admin
Route::group(['middleware' => ['api','cors', 'auth.jwt','AdminRole']], function() {
    Route::delete('events/delete/{id}', [EventController::class, 'delete']);
    Route::post('events/create', [EventController::class, 'save']);
    Route::put('events/update/{id}', [EventController::class, 'update']);
    Route::post('events/setVac/{id}', [EventController::class, 'setUserVac']);
});
