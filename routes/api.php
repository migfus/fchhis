<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(\App\Http\Controllers\AuthController::class)->group(function () {
  Route::post('/login', 'Login');
  Route::post('/register', 'Register');
  Route::post('/recovery', 'Recovery');
  Route::post('/recovery-confirm', 'ConfirmRecovery');
  Route::post('/change-password-recovery', 'ChangePasswordRecovery');
});

// NOTE PUBLICS API
Route::group(['prefix' => 'public', 'as' => 'public.'], function() {
  Route::apiResource('/address', \App\Http\Controllers\AddressPublicController::class)->only(['index']);
  Route::apiResource('/post', \App\Http\Controllers\PostPublicController::class)->only(['index', 'show']);
  Route::apiResource('/job', \App\Http\Controllers\JobPublicController::class)->only(['index']);
  Route::apiResource('/faq', \App\Http\Controllers\FAQPublicController::class)->only(['index']);
  Route::apiResource('/event', \App\Http\Controllers\EventPublicController::class)->only(['index']);
    Route::get('/event/count', [\App\Http\Controllers\EventPublicController::class, 'getCount']);
});


Route::middleware('auth:sanctum')->group(function () {
});
