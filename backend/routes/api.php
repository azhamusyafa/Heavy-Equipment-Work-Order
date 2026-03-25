<?php

use App\Http\Controllers\EquipmentCategoryController;
use App\Http\Controllers\MaintenanceTypeController;
use App\Http\Controllers\WorkOrderController;
use App\Http\Controllers\WorkshopLocationController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth.basic')->group(function () {

    Route::prefix('equipment-categories')->group(function () {
        Route::get('/', [EquipmentCategoryController::class, 'index']);
        Route::post('/', [EquipmentCategoryController::class, 'store']);
        Route::put('/{equipmentCategory}', [EquipmentCategoryController::class, 'update']);
        Route::patch('/{equipmentCategory}', [EquipmentCategoryController::class, 'patch']);
        Route::delete('/{equipmentCategory}', [EquipmentCategoryController::class, 'destroy']);
    });

    Route::prefix('maintenance-types')->group(function () {
        Route::get('/', [MaintenanceTypeController::class, 'index']);
        Route::post('/', [MaintenanceTypeController::class, 'store']);
        Route::put('/{maintenanceType}', [MaintenanceTypeController::class, 'update']);
        Route::patch('/{maintenanceType}', [MaintenanceTypeController::class, 'patch']);
        Route::delete('/{maintenanceType}', [MaintenanceTypeController::class, 'destroy']);
    });

    Route::prefix('workshop-locations')->group(function () {
        Route::get('/', [WorkshopLocationController::class, 'index']);
        Route::post('/', [WorkshopLocationController::class, 'store']);
        Route::put('/{workshopLocation}', [WorkshopLocationController::class, 'update']);
        Route::patch('/{workshopLocation}', [WorkshopLocationController::class, 'patch']);
        Route::delete('/{workshopLocation}', [WorkshopLocationController::class, 'destroy']);
    });

    Route::prefix('work-orders')->group(function () {
        Route::get('/', [WorkOrderController::class, 'index']);
        Route::post('/', [WorkOrderController::class, 'store']);
        Route::patch('/{workOrder}/inspect', [WorkOrderController::class, 'inspect']);
        Route::patch('/{workOrder}/assign-mechanic', [WorkOrderController::class, 'assignMechanic']);
        Route::patch('/{workOrder}/complete', [WorkOrderController::class, 'complete']);
    });

});