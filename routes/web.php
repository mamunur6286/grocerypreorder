<?php

use GroceryStore\PreOrderManagement\Controllers\Api\PreOrderController;
use Illuminate\Support\Facades\Route;


Route::group([
    'namespace' => 'GroceryStore\PreOrderManagement\Controllers',
    'prefix' => 'api/v1/grocery-store'
], function () {

    Route::group(['prefix' => 'pre-orders', 'as' => 'api.pre_order'], function () {
        Route::get('/', [PreOrderController::class, 'index'])->name('index');
        Route::post('/store', [PreOrderController::class, 'store'])->name('store');
        Route::delete('/remove/{id}', [PreOrderController::class, 'destroy'])->name('delete');
    });

});
