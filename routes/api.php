<?php

use App\Actions\App\StatusAction;
use App\Actions\Auth\MagicLinkAuthenticationAction;
use App\Actions\Auth\MagicLinkValidation;
use App\Actions\User\MeAction;
use Illuminate\Support\Facades\Route;

Route::get('/status', StatusAction::class);

Route::middleware(['web'])->group(function () {
    Route::prefix('auth')
        ->middleware(['throttle:6,1'])
        ->group(function () {
            Route::post('/magic-link', MagicLinkAuthenticationAction::class)->middleware('api.quest');
            Route::post('/magic-link/validate', MagicLinkValidation::class);
        });

    Route::prefix('user')
        ->group(function () {
            Route::get('/me', MeAction::class);
        });
});
