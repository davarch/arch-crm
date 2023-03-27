<?php

declare(strict_types=1);

use App\Http\Controllers\Api\Contacts\IndexController as ContactIndex;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')
    ->group(function () {
        Route::prefix('contacts')
            ->as('contacts:')
            ->group(function () {
                Route::get('/', ContactIndex::class)
                    ->name('index');
            });
    });
