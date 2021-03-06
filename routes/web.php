<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CardController;
use App\Http\Controllers\Api\DeskController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\HomeController;
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
Route::group([
    'as' => 'auth.',
], function () {

    Route::group(['middleware' => 'guest', 'as' => 'login-'], function () {
        Route::get('/', [AuthController::class, 'show'])->name('page');
        Route::post('/', [AuthController::class, 'login'])->name('action');
    });

    Route::get('logout', [AuthController::class, 'logout'])
        ->name('logout')
        ->middleware('auth');
});

Route::group(['middleware' => 'auth', 'prefix' => 'dashboard'], function () {
    Route::get('/', HomeController::class)->name('dashboard');

    Route::resources([
        'desks'             => DeskController::class,
        'desks.cards'       => CardController::class,
        'desks.cards.tasks' => TaskController::class
    ]);
});
