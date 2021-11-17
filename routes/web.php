<?php

use App\Http\Controllers\ConversationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VkontakteAuth;
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

Route::get('/', function () {
    return view('components.homepage.home');
})->name('home');

Route::get('/addadmin', function () {
    return view('addadmin');
})->name('addadmin');

Route::get('/test', [ConversationController::class, 'parse']);

Route::get('/t', [VkontakteAuth::class, 'test']);

