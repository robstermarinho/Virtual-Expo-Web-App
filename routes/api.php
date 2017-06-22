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

/**
 * Events
 */
Route::resource('events', 'Event\EventController', ['only' => ['index', 'show']]);
Route::resource('events.stands', 'Event\EventStandController', ['only' => ['index']]);


/**
 * Users
 */
Route::resource('users', 'User\UserController', ['only' => ['index', 'show']]);