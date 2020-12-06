<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/', '\EnglandSoccerCup\Http\Controllers\Frontend\EnglandSoccerCupActions@get');
Route::get('/results/group', '\EnglandSoccerCup\Http\Controllers\Frontend\ScheduleActionsController@generateGroup');
Route::get('/results/playoff', '\EnglandSoccerCup\Http\Controllers\Frontend\ScheduleActionsController@generatePlayOff');
Route::get('/results/truncate', '\EnglandSoccerCup\Http\Controllers\Frontend\ClearActions@truncate');
