<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\TestimonialController;

Route::middleware('auth:sanctum')->group(function () {

    // Projects
    Route::get('/projects', [ProjectController::class, 'index']);
    Route::get('/projects/{slug}', [ProjectController::class, 'show']);

    // Likes — throttled to prevent spam (30 req/min per IP)
    Route::get('/projects/{slug}/like', [ProjectController::class, 'likeStatus'])
        ->middleware('throttle:30,1');
    Route::post('/projects/{slug}/like', [ProjectController::class, 'like'])
        ->middleware('throttle:10,1');
    Route::delete('/projects/{slug}/like', [ProjectController::class, 'unlike'])
        ->middleware('throttle:10,1');

    // Services
    Route::get('/services', [ServiceController::class, 'index']);

    // Testimonials
    Route::get('/testimonials', [TestimonialController::class, 'index']);

    // Contact — rate limited to 5 submissions per minute per IP
    Route::post('/contact', [ContactController::class, 'store'])
        ->middleware('throttle:5,1');

    Route::get('/profile', [ProfileController::class, 'show']);
});