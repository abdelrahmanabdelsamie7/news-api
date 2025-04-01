<?php

use App\Http\Controllers\API\{CategoryController,ReportController,ReportImageController,AuthorController ,ShareIdeaController,SubscriberController};
use App\Http\Controllers\AuthAdminController;
Route::middleware(['api'])->prefix('admin')->group(function() {
    Route::post('/login', [AuthAdminController::class, 'login']);
    Route::post('/logout', [AuthAdminController::class, 'logout']);
    Route::post('/register', [AuthAdminController::class, 'register']);
    Route::get('/getaccount', [AuthAdminController::class, 'getaccount']);
});
Route::apiResource('categories' , CategoryController::class);
Route::apiResource('reports' , ReportController::class);
Route::apiResource('authors' , AuthorController::class);
Route::apiResource('report-images' , ReportImageController::class);
Route::apiResource('subscribers' , SubscriberController::class);
Route::apiResource('share-ideas' , ShareIdeaController::class);
Route::post('share-ideas/{id}/reply' , [ShareIdeaController::class,'reply']);
Route::match(['post', 'put', 'patch'], 'reports/{id}', [ReportController::class, 'update']);
Route::match(['post', 'put', 'patch'], 'authors/{id}', action: [AuthorController::class, 'update']);