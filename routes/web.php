<?php

use App\Http\Controllers\ConversationController;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\VkontakteAuth;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/panel', function () {
    return view('components.homepage.home');
})->name('home')->middleware(['auth', 'access:can_conv']);

Route::get('/add', function () {
    return view('addadmin');
})->name('add')->middleware(['auth', 'access:can_conv']);

Route::get('/logout', function () {
    Auth::logout();
});

Route::get('/settings', function () {
    return view('components.settings.settings');
})->name('settings')->middleware(['auth', 'access:can_conv']);
Route::get('/oauth/vk', [VkontakteAuth::class, 'redirect']);
Route::get('/oauth/vk/callback', [VkontakteAuth::class, 'callback']);
//Route::get('/test', [ConversationController::class, 'parse']);
Route::get('/c/{id}', [ConversationController::class, 'index'])->name('adminconv')->middleware(['auth', 'access:can_conv']);
//Route::get('/t', [VkontakteAuth::class, 'test']);
Route::get('/logs', [LogsController::class, 'index'])->name('logs')->middleware(['auth', 'access:can_conv']);

