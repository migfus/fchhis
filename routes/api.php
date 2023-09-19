<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/test', function() {
    return response()->json(['test' => 'test']);
});

Route::group(['prefix' => 'email', 'as' => 'email.'], function() {
    Route::post('/forgot',   [\App\Http\Controllers\EmailController::class, 'registration']);
    Route::post('/recovery', [\App\Http\Controllers\EmailController::class, 'recovery']);
});


Route::controller(\App\Http\Controllers\AuthController::class)->group(function () {
    Route::post('/login', 'Login');
});

// NOTE PUBLICS API
Route::group(['prefix' => 'public', 'as' => 'public.'], function() {
    Route::apiResource('/address', \App\Http\Controllers\Public\AddressPublicController::class)->only(['index']);
    Route::apiResource('/post',    \App\Http\Controllers\Public\PostPublicController::class)->only(['index', 'show']);
    Route::apiResource('/job',     \App\Http\Controllers\Public\JobPublicController::class)->only(['index']);
    Route::apiResource('/faq',     \App\Http\Controllers\Public\FAQPublicController::class)->only(['index']);
    Route::apiResource('/event',   \App\Http\Controllers\Public\EventPublicController::class)->only(['index']);
});


Route::middleware('auth:sanctum')->group(function () {
    Route::group(['prefix' => 'auth', 'as' => 'auth.'], function() {
        Route::apiResource('/document', \App\Http\Controllers\DocumentAuthController::class)->only(['index', 'destroy', 'store']);
        Route::post('change-password', [\App\Http\Controllers\AuthController::class, 'ChangePassword']);
        Route::post('change-avatar',   [\App\Http\Controllers\AuthController::class, 'ChangeAvatar']);
    });

    Route::apiResource('/statistic',   \App\Http\Controllers\StatisticController::class)->only(['index']);
    Route::apiResource('/beneficiary', \App\Http\Controllers\BeneficiaryController::class)->only(['index']);
    Route::apiResource('/users',       \App\Http\Controllers\UserController::class)->only(['index', 'destroy']);
    Route::apiResource('/transaction', \App\Http\Controllers\TransactionController::class)->only(['index']);
});
