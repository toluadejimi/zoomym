<?php

use Illuminate\Support\Facades\Route;
use Modules\ParcelManagement\Http\Controllers\Api\Customer\ParcelController;
use Modules\TripManagement\Http\Controllers\Api\Customer\TripRequestController;

Route::group(['prefix' => 'customer'], function () {
    Route::group(['prefix' => 'parcel', 'middleware' => ['auth:api', 'maintenance_mode']], function () {
        Route::controller(Modules\ParcelManagement\Http\Controllers\Api\New\Customer\ParcelCategoryController::class)->group(function () {
            Route::get('category', 'categoryFareList');
        });
        Route::controller(Modules\ParcelManagement\Http\Controllers\Api\New\Customer\ParcelController::class)->group(function () {
            Route::get('vehicle', 'vehicleList');
        });
        Route::controller(TripRequestController::class)->group(function () {
            Route::post('create', 'createRideRequest');
        });
    });
});

Route::group(['prefix' => 'customer'], function () {
    Route::group(['prefix' => 'parcel', 'middleware' => ['auth:api', 'maintenance_mode']], function () {
        Route::get('details/{ride_request_id}', [ParcelController::class, 'orderDetails']);
        Route::get('list', [ParcelController::class, 'orderList']);
        Route::get('track-driver', [ParcelController::class, 'trackDriver']);
        Route::get('suggested-vehicle-category', [ParcelController::class, 'suggestedVehicleCategory']);
    });
});

Route::group(['prefix' => 'driver'], function () {
    Route::group(['prefix' => 'parcel', 'middleware' => ['auth:api', 'maintenance_mode']], function () {
        Route::put('update-status', [ParcelController::class, 'statusUpdate']);
    });
});
