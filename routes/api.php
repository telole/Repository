<?php

use App\Http\Controllers\AplyingController;
use App\Http\Controllers\ApplyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobVacancyController;
use App\Http\Controllers\ValidationController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');



route::prefix('v1')->group(function() {
    Route::post('auth/login',[AuthController::class, 'login']);
    Route::middleware('auth:sanctum')->group(function(){
        Route::post('auth/logout',[AuthController::class, 'logout']);
        Route::post('/validations',[ValidationController::class, 'requestValidation']);
        Route::get('/validations',[ValidationController::class, 'getValidation']);
        Route::get('/job_vacancies', [JobVacancyController::class, 'getJobVacancies']);
        Route::get('/job_vacancies/{id}', [JobVacancyController::class, 'getJobVacancyDetail']);
        route::post('/applications', [ApplyController::class, 'applyForJob']);
        Route::get('/applications', [ApplyController::class, 'getAllApplications']);
    });
}
);