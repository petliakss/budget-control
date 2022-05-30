<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'api/pss_budget_control/v1', 'middleware' => 'api'], function () {
    Route::controller(Petliakss\BudgetControl\Http\Controllers\PaymentsHistoryController::class)
        ->prefix('payments_history')->group(function () {
            Route::post('/store', 'store');
            Route::put('/{item}/update', 'update');
            Route::delete('/{item}/delete', 'destroy');
            Route::get('/list', 'index');
            Route::get('/balance', 'balance');
            Route::get('/{item}', 'show');
        });
    Route::controller(Petliakss\BudgetControl\Http\Controllers\CategoryController::class)
        ->prefix('categories')->group(function () {
            Route::post('/store', 'store');
            Route::put('/{category}/update', 'update');
            Route::delete('/{category}/delete', 'destroy');
            Route::get('/list', 'index');
            Route::get('/{category}', 'show');
        });
});
