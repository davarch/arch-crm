<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')
    ->group(function () {
        Route::prefix('contacts')
            ->as('contacts:')
            ->group(function () {
                Route::get('/', \App\Http\Controllers\Api\Contacts\IndexController::class)
                    ->name('index');

                Route::post('/', \App\Http\Controllers\Api\Contacts\StoreController::class)
                    ->name('store');

                Route::get('{uuid}', \App\Http\Controllers\Api\Contacts\ShowController::class)
                    ->name('show');

                Route::put('{uuid}', \App\Http\Controllers\Api\Contacts\UpdateController::class)
                    ->name('update');
            });
    });
