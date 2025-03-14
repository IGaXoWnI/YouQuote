<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\CitationController;



Route::get('/citations', [CitationController::class, 'getAllCitations']);
Route::get('/citations/{citation}', [CitationController::class, 'showCitation']);
Route::get('/popular', [CitationController::class, 'getPopolarCitations']);
Route::get('/random', [CitationController::class, 'getRandomCitations']);
Route::get('/word_count/{length}', [CitationController::class, 'getCitationByWordCount']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/citations', [CitationController::class, 'storeCitation']);
    Route::put('/citations/{citation}', [CitationController::class, 'updateCitation']);
    Route::delete('/citations/{citation}', [CitationController::class, 'destroyCitation']);

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
});
