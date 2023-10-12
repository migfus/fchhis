<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EmailController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Public\AddressPublicController;
use App\Http\Controllers\Public\PostPublicController;
use App\Http\Controllers\Public\JobPublicController;
use App\Http\Controllers\Public\FAQPublicController;
use App\Http\Controllers\Public\EventPublicController;
use App\Http\Controllers\DocumentAuthController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\BeneficiaryController;
use App\Http\Controllers\ClientUserController;
use App\Http\Controllers\AgentUserController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\PaymentTypeSelectController;
use App\Http\Controllers\AgentSelectController;
use App\Http\Controllers\PlanSelectionController;

Route::get('/test',   [\App\Http\Controllers\TestController::class, 'index']);

Route::group(['prefix' => 'email', 'as' => 'email.'], function() {
    Route::post('/forgot',   [EmailController::class, 'registration']);
    Route::post('/recovery', [EmailController::class, 'recovery']);
});


Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'Login');
});

// NOTE PUBLICS API
Route::group(['prefix' => 'public', 'as' => 'public.'], function() {
    Route::apiResource('/address', AddressPublicController::class)->only(['index']);
    Route::apiResource('/post',    PostPublicController::class)->only(['index', 'show']);
    Route::apiResource('/job',     JobPublicController::class)->only(['index']);
    Route::apiResource('/faq',     FAQPublicController::class)->only(['index']);
    Route::apiResource('/event',   EventPublicController::class)->only(['index']);
});


Route::middleware('auth:sanctum')->group(function () {
    Route::group(['prefix' => 'auth', 'as' => 'auth.'], function() {
        Route::apiResource('/document', DocumentAuthController::class)->only(['index', 'destroy', 'store']);
        Route::post('change-password', [AuthController::class, 'ChangePassword']);
        Route::post('change-avatar',   [AuthController::class, 'ChangeAvatar']);
    });

    Route::apiResource('/statistic',   StatisticController::class)->only(['index']);
    Route::apiResource('/beneficiary', BeneficiaryController::class)->only(['index', 'store', 'destroy', 'update']);
    Route::apiResource('/users/client',ClientUserController::class)->only(['index', 'store']);
    Route::apiResource('/users/agent', AgentUserController::class)->only(['index', 'store']);

    Route::get('/users/download/{id}', [UserController::class, 'download']);
    Route::apiResource('/users',    UserController::class)->only(['index', 'destroy', 'show', 'update']);

    Route::apiResource('/transaction', TransactionController::class);

    Route::group(['prefix' => 'select', 'as' => 'select.'], function() {
        Route::get('payment-type', [PaymentTypeSelectController::class, 'index']);
        Route::get('agent',        [AgentSelectController::class, 'index']);
        Route::get('plan',         [PlanSelectionController::class, 'index']);
    });
});
