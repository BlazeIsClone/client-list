<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompanyController;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Actions Handled By Resource Controller
|--------------------------------------------------------------------------
|
| METHOD		ENDPOINT				FUNCTION
|
| GET		/endpoint				index
| GET			/endpoint/create		create
| POST			/endpoint 				store
| GET			/endpoint/{key}			show
| GET			/endpoint/{key}/edit	edit
| PUT/PATCH		/endpoint/{key}			update
| DELETE		/endpoint/{key}			destroy
|
*/

Route::resource('clients', ClientController::class);
Route::resource('companies', CompanyController::class);

Route::get('/', function () {
    foreach (Route::getRoutes() as $value) {
        $data[] = $value;
    }

    return new JsonResource($data);
});
