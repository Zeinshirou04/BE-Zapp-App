<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\TestimonialController;

Route::middleware('auth:sanctum')->group(function () {
 
    // Projects
    Route::get('/projects', [ProjectController::class, 'index']);
    Route::get('/projects/{slug}', [ProjectController::class, 'show']);
 
    // Services
    Route::get('/services', [ServiceController::class, 'index']);
 
    // Testimonials
    Route::get('/testimonials', [TestimonialController::class, 'index']);
 
    // Contact — rate limited to 5 submissions per minute per IP
    Route::post('/contact', [ContactController::class, 'store'])
        ->middleware('throttle:5,1');
});
