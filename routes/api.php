<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/test', function() {
  return response()->json(['test' => 'test']);
});

Route::controller(\App\Http\Controllers\AuthController::class)->group(function () {
  Route::post('/login', 'Login');
  Route::post('/register', 'Register');
  Route::post('/recovery', 'Recovery');
  Route::post('/recovery-confirm', 'ConfirmRecovery');
  Route::post('/change-password-recovery', 'ChangePasswordRecovery');
});

// NOTE PUBLICS API
Route::group(['prefix' => 'public', 'as' => 'public.'], function() {
  Route::apiResource('/address', \App\Http\Controllers\Public\AddressPublicController::class)->only(['index']);
  Route::apiResource('/post',    \App\Http\Controllers\Public\PostPublicController::class)->only(['index', 'show']);
  Route::apiResource('/job',     \App\Http\Controllers\Public\JobPublicController::class)->only(['index']);
  Route::apiResource('/faq',     \App\Http\Controllers\Public\FAQPublicController::class)->only(['index']);
  Route::apiResource('/event',   \App\Http\Controllers\Public\EventPublicController::class)->only(['index']);
    Route::get('/event/count',  [\App\Http\Controllers\Public\EventPublicController::class, 'getCount']);
});


Route::middleware('auth:sanctum')->group(function () {
  Route::group(['prefix' => 'auth', 'as' => 'auth.'], function() {
    Route::apiResource('/document', \App\Http\Controllers\DocumentAuthController::class)->only(['index', 'destroy', 'store']);
  });

  Route::apiResource('/users', \App\Http\Controllers\UserController::class)->only(['index', 'destroy']);
});
