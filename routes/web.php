<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\TestController;

Route::middleware(['auth'])->group(function () {
	Route::view('/', 'welcome');
	Route::resource('/accounts', AccountController::class);
	Route::post('/accounts/{account}/test', [AccountController::class, 'test']);
	Route::get('/test-all', [AccountController::class, 'testAll']);
	Route::resource('/tests', TestController::class);
});


Auth::routes();

Route::get('/register', function(){return redirect('/login');});

