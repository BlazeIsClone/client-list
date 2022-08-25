<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Resource Controllers
|--------------------------------------------------------------------------
|
| We register all our CRUD operations though a single resource controller.
|
| https://laravel.com/docs/9.x/controllers#resource-controllers
|
*/

Route::resource('companies', CompanyController::class);

Route::resource('clients', ClientController::class);

Route::get('/user', [UserController::class, 'index']);

Route::delete('/user', [UserController::class, 'destroy']);
