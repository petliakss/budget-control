<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'api/pss_budget_control/v1', 'middleware' => 'api'], function () {
    Route::controller(Petliakss\BudgetControl\Http\Controllers\PaymentsHistoryController::class)
        ->prefix('payments_history')->group(function () {
            Route::post('/store', 'store');
            Route::put('/update/{item}', 'update');
            Route::delete('/delete/{item}', 'destroy');
            Route::get('/get/{item}', 'show');
            Route::get('/list', 'index');
            Route::get('/balance', 'balance');
        });
    Route::controller(Petliakss\BudgetControl\Http\Controllers\CategoryController::class)
        ->prefix('categories')->group(function () {
            Route::post('/store', 'store');
            Route::put('/update/{category}', 'update');
            Route::delete('/delete/{category}', 'destroy');
            Route::get('/get/{category}', 'show');
            Route::get('/list', 'index');
        });
});
