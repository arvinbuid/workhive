<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/jobs', function () {
    return '<h1>Available Jobs.';
});

/// Route with constraint
Route::get('/jobs/{id}/comments/{commentId}', function (string $id, string $commentId) {
    return 'Post ' . $id . ' Comment ' . $commentId;
})->whereNumber('id')->whereNumber('commentId'); 