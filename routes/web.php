<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return redirect('/dashboard');
});
Route::get('/dashboard', 'PageController@dashboard');
Route::get('/preferences', 'PageController@preferences');