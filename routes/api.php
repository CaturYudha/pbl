<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\RuanganController;


Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);

// Rute CRUD untuk jurusan
Route::get('/jurusans', [JurusanController::class, 'index']);
Route::post('/jurusans', [JurusanController::class, 'store']);
Route::get('/jurusans/{id}', [JurusanController::class, 'show']);
Route::put('/jurusans/{id}', [JurusanController::class, 'update']);
Route::delete('/jurusans/{id}', [JurusanController::class, 'destroy']);

Route::get('/ruangans', [RuanganController::class, 'index']);
Route::post('/ruangans', [RuanganController::class, 'store']);
Route::get('/ruangans/{id}', [RuanganController::class, 'show']);
Route::put('/ruangans/{id}', [RuanganController::class, 'update']);
Route::delete('/ruangans/{id}', [RuanganController::class, 'destroy']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
