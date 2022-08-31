<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\MessageController;
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

Route::get('/', [ChatController::class, 'index'])->name('chatapp.home');
Route::get('/message', [MessageController::class, 'getBySession'])->name('chatapp.message.get_by_session');
Route::post('/message', [MessageController::class, 'store'])->name('chatapp.message.store');
