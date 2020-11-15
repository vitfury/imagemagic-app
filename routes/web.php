<?php

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
    return view('home');
});


Route::get('/about', function () {
    return view('about');
});

Route::get('/editor', [\App\Http\Controllers\EditorController::class, 'index']);

Route::get('/contacts', function () {
    return view('contacts');
});

Route::get('/gallery', function () {
    return view('gallery');
});

Auth::routes();

Route::get('login/google', [\App\Http\Controllers\Auth\LoginController::class, 'redirectToProvider']);
Route::get('login/google/callback', [\App\Http\Controllers\Auth\LoginController::class, 'handleProviderCallback']);
