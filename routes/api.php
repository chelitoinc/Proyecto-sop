<?php

use Illuminate\Http\Request;

/* 
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::get('/partidas/{id}/urg','PartidaController@show');
