<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);

// This will take care of index, create, store, show, edit, update, destroy job controller methods
Route::resource('jobs', JobController::class);
