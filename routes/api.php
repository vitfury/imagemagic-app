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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/image/resize', 'Api\ImageController@resize');

Route::post('/image/removeBackground', 'Api\ImageController@removeBackground');

Route::middleware('auth.token')->post('/image/removeBackgroundBinary', 'Api\ImageController@removeBackgroundBinary');

Route::middleware('auth.token')->post('/sticker/create', 'Api\StickerController@create');

Route::middleware('auth.token')->post('/sticker/save/{id}', 'Api\StickerController@save');

Route::middleware('auth.token')->get('/sticker/get/{id}', 'Api\StickerController@get');
