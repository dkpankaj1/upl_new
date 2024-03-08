<?php

use App\Http\Controllers\Api\AuthSessionController;
use App\Http\Controllers\Api\RawPollController;
use Illuminate\Support\Facades\Route;


/** ---------- public api route :: BEGIN ---------- */
Route::post('login', [AuthSessionController::class, "store"]);
/** ---------- public api route :: END ---------- */



/** ---------- protected api route :: BEGIN ---------- */
Route::middleware('auth:sanctum')->group(function () {

    Route::apiResource('raw-polls',RawPollController::class);

    Route::post('logout',[AuthSessionController::class,'destroy']);
});
/** ---------- protected api route :: END ---------- */


