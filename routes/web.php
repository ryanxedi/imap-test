<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\TestController;

Route::view('/', 'welcome');
Route::resource('/accounts', AccountController::class);
Route::get('/accounts/{account}/test', [AccountController::class, 'test']);
Route::resource('/tests', TestController::class);