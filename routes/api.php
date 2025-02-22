<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'API';
});

/*Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});*/
