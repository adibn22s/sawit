<?php

use App\Http\Controllers\IndexController;

use Illuminate\Support\Facades\Route;

Route::get('/do-kecil', [IndexController::class, 'index']);

Route::get('/', function () {
    return view('welcome');
});
