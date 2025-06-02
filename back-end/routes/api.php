<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return response("API 1.0");
});

Route::get('/v1/home-data', [\App\Http\Controllers\HomeController::class, 'index']);
Route::apiResource('/v1/livros', \App\Http\Controllers\LivroController::class);
Route::apiResource('/v1/assuntos', \App\Http\Controllers\AssuntoController::class);
Route::get('/v1/autores/livros-por-autor/{cod}', [\App\Http\Controllers\AutorController::class, 'booksByAuthor']);
Route::apiResource('/v1/autores', \App\Http\Controllers\AutorController::class);

