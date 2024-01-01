<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\VehiclesController;
use App\Http\Resources\ClientsResource;
use App\Models\Clients;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/clients', [ClientsController::class, 'index']);
Route::get('/clients/{id}', [ClientsController::class, 'show']);
Route::put('/clients/{id}', [ClientsController::class, 'update']);
Route::post('/clients/create', [ClientsController::class, 'store']);
Route::delete('/clients/{id}', [ClientsController::class, 'destroy']);

Route::get('/vehicles', [VehiclesController::class, 'index']);
Route::get('/vehicles/{id}', [VehiclesController::class, 'show']);
Route::put('/vehicles/{id}', [VehiclesController::class, 'update']);
Route::post('/vehicles', [VehiclesController::class, 'store']);
Route::delete('/vehicles/{id}', [VehiclesController::class, 'destroy']);

Route::get('/services', [ServicesController::class, 'index']);
Route::get('/services/{id}', [ServicesController::class, 'show']);
Route::put('/services/{id}', [ServicesController::class, 'update']);
Route::post('/services', [ServicesController::class, 'store']);
Route::delete('/services/{id}', [ServicesController::class, 'destroy']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
