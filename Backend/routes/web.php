<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Event;

use App\Http\Controllers\EventController;

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
/*
Route::get('/', [EventController::class, 'index']);
Route::get('/events', [EventController::class,'index']);
Route::get('events/{event}', [EventController::class,'show']);
*/
/*
Route::get('/', function () {
    $events = DB::table('events')->get();
    //return $events;
    return view('welcome', compact ('events'));
});

Route::get('/events', function () {
    $events = Event::all();
    return view('events.index', compact ('events'));
});

Route::get('/events/{id}', function ($id) {
    $event = Event::find($id);
    return view('events.show', compact ('event'));
});

*/
