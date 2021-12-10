<?php

use App\Http\Controllers\ConversationController;
use App\Http\Controllers\LogsController;
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
})->name('home')->middleware(['auth']);

Route::get('/add', function () {
    return view('addadmin');
})->name('add')->middleware(['auth']);

Route::get('/logout', function (){
   Auth::logout();
});

Route::get('/settings', function () {
    return view('components.settings.settings');
})->name('settings')->middleware(['auth']);
Route::get('/oauth/vk', [VkontakteAuth::class, 'redirect']);
Route::get('/oauth/vk/callback', [VkontakteAuth::class, 'callback']);
Route::get('/test', [ConversationController::class, 'parse']);
Route::get('/c/{id}', [ConversationController::class, 'index'])->name('adminconv')->middleware(['auth']);
Route::get('/t', [VkontakteAuth::class, 'test']);
Route::get('/logs', [LogsController::class, 'index'])->name('logs')->middleware(['auth']);

