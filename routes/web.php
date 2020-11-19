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

Route::get('/', [
    'as' => 'home',
    'uses' => 'HomeController@index'
]);


Route::get('/about', function () {
    return view('about');
});

Route::get('/editor', [\App\Http\Controllers\EditorController::class, 'index']);

Route::get('/delete', [\App\Http\Controllers\DeleteController::class, 'index']);

Route::get('/contacts', function () {
    return view('contacts');
});

Route::get('/account', function () {
    return view('layouts.app');
});

Route::get('/gallery', function () {
    return view('gallery');
});

Auth::routes();

Route::get('login/{provider}', [\App\Http\Controllers\Auth\LoginController::class, 'redirectToProvider']);
Route::get('login/{provider}/callback', [\App\Http\Controllers\Auth\LoginController::class, 'handleProviderCallback']);

Route::get('/FAQ', function () {
    return view('FAQ');
});
