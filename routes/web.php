<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/jobs', [JobController::class, 'index']);
Route::get('/create', [JobController::class, 'create']);
Route::get('/show/{id}', [JobController::class, 'show']);
Route::post('/jobs', [JobController::class, 'store']);
