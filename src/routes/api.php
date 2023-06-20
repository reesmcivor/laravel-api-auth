<?php

use Illuminate\Support\Facades\Route;

use ReesMcIvor\ApiAuth\Http\Controllers as Controllers;

Route::middleware(['api', \ReesMcIvor\ApiAuth\Http\Middleware\CheckApiKeys::class])->group(function () {
    Route::prefix('api')->name('api.')->group(function() {
        Route::post('check', [Controllers\ApiKeyController::class, 'check'])->name('user.check');
    });
});
