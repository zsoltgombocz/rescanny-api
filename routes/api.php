<?php

use App\Http\Actions\App\StatusAction;
use App\Http\Actions\Auth\LogoutAction;
use App\Http\Actions\Auth\MagicLinkAuthenticationAction;
use App\Http\Actions\Auth\MagicLinkValidationAction;
use App\Http\Actions\Pages\ShowPageAction;
use App\Http\Actions\User\ConfirmEmailChangeAction;
use App\Http\Actions\User\DeleteAction;
use App\Http\Actions\User\MeAction;
use App\Http\Actions\User\RequestEmailChangeAction;
use App\Http\Actions\User\UpdatePersonalInformationAction;
use Illuminate\Support\Facades\Route;

Route::get('/status', StatusAction::class);

Route::middleware(['web'])->group(function () {
    Route::prefix('auth')
        ->middleware(['throttle:6,1'])
        ->group(function () {
            Route::post('/magic-link', MagicLinkAuthenticationAction::class)->middleware('api.quest');
            Route::post('/magic-link/validate', MagicLinkValidationAction::class)->middleware('api.quest');

            Route::post('/logout', LogoutAction::class)->middleware('auth:web');
        });

    Route::prefix('user')
        ->middleware('auth:web')
        ->group(function () {
            Route::get('/me', MeAction::class);
            Route::post('/delete', DeleteAction::class);

            Route::post('/update/personal', UpdatePersonalInformationAction::class)->middleware(['throttle:6,0.5']);

            Route::post('/email-change/request', RequestEmailChangeAction::class);
            Route::post('/email-change/confirm', ConfirmEmailChangeAction::class);
        });

    Route::get('pages/{slug}', ShowPageAction::class);
});
