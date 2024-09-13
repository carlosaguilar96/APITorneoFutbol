<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\equipoController;
use App\Http\Controllers\jugadorController;
use App\Http\Controllers\partidoController;
use App\Http\Controllers\resultadoController;

//Rutas para realizar CRUD de Equipos
Route::post( '/equipos', [equipoController::class, 'store']);
Route::get( '/equipos', [equipoController::class, 'index']);
Route::get( '/equipos/{id}', [equipoController::class, 'show']);
Route::delete( '/equipos/{id}', [equipoController::class, 'destroy']);
Route::put( '/equipos/{id}', [equipoController::class, 'update']);

//Rutas para realizar CRUD de Jugadores
Route::post( '/jugadores', [jugadorController::class, 'store']);
Route::get( '/jugadores', [jugadorController::class, 'index']);
Route::get( '/jugadores/{id}', [jugadorController::class, 'show']);
Route::delete( '/jugadores/{id}', [jugadorController::class, 'destroy']);
Route::put( '/jugadores/{id}', [jugadorController::class, 'update']);

//Rutas para realizar CRUD de Partidos
Route::post( '/partidos', [partidoController::class, 'store']);
Route::get( '/partidos', [partidoController::class, 'index']);
Route::get( '/partidos/{id}', [partidoController::class, 'show']);
Route::delete( '/partidos/{id}', [partidoController::class, 'destroy']);
Route::put( '/partidos/{id}', [partidoController::class, 'update']);

//Rutas para realizar CRUD de Resultados
Route::post( '/resultados', [resultadoController::class, 'store']);
Route::get( '/resultados', [resultadoController::class, 'index']);
Route::get( '/resultados/{id}', [resultadoController::class, 'show']);
Route::delete( '/resultados/{id}', [resultadoController::class, 'destroy']);
Route::put( '/resultados/{id}', [resultadoController::class, 'update']);