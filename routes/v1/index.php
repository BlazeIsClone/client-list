<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/**
 * Resource Controllers
 *
 * @see https://laravel.com/docs/9.x/controllers#resource-controllers
 */

Route::resource('clients', ClientController::class);
Route::resource('companies', CompanyController::class);
Route::resource('users', UserController::class);
