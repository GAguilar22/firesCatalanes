<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\APIController::class, 'getPhotosFromAPI']);
Route::get('/save', [App\Http\Controllers\APIController::class, 'saveDataFromAPI']);
Route::get('/getbd', [App\Http\Controllers\APIController::class, 'getPhotosFromBD']);
