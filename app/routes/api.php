<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\VehiclesReportController;
use App\Http\Controllers\ClientsReportController;
use App\Http\Controllers\ReviewsReportController;
use App\Http\Controllers\VehiclesController;

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
Route::post('/vehicles/create', [VehiclesController::class, 'store']);
Route::delete('/vehicles/{id}', [VehiclesController::class, 'destroy']);

Route::get('/review', [ReviewsController::class, 'index']);
Route::get('/review/{id}', [ReviewsController::class, 'show']);
Route::put('/review/{id}', [ReviewsController::class, 'update']);
Route::post('/review/create', [ReviewsController::class, 'store']);
Route::delete('/review/{id}', [ReviewsController::class, 'destroy']);

Route::get(
    '/report/vehicleByPerson',
    [VehiclesReportController::class, 'vehicleByPerson']
);
Route::get(
    '/report/vehicleByGender',
    [VehiclesReportController::class, 'vehicleByGender']
);
Route::get(
    '/report/vehicleByBrand',
    [VehiclesReportController::class, 'vehicleByBrand']
);
Route::get(
    '/report/vehicleByBrandGender',
    [VehiclesReportController::class, 'vehicleByBrandGender']
);

Route::get(
    '/report/averageAgeByGender',
    [ClientsReportController::class, 'averageAgeByGender']
);

Route::get(
    '/report/reviewsByBrand',
    [ReviewsReportController::class, 'reviewsByBrand']
);

Route::get(
    '/report/reviewsByClient',
    [ReviewsReportController::class, 'reviewsByClient']
);

Route::get(
    '/report/averageTimeBetweenReviews/{id}',
    [ReviewsReportController::class, 'averageTimeBetweenReviews']
);

Route::get(
    '/report/reviewsByPeriod/{beginFilter}/{endFilter}',
    [ReviewsReportController::class, 'reviewsByPeriod']
);

Route::get(
    '/report/predictionReviews/',
    [ReviewsReportController::class, 'predictionReviews']
);
Route::get(
    '/report/predictionReviewsV2/',
    [ReviewsReportController::class, 'predictionReviewsV2']
);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
