<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\CitationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;

Route::get('/citations', [CitationController::class, 'getAllCitations']);
Route::get('/citations/{citation}', [CitationController::class, 'showCitation']);
Route::get('/popular', [CitationController::class, 'getPopolarCitations']);
Route::get('/random', [CitationController::class, 'getRandomCitations']);
Route::get('/word_count/{length}', [CitationController::class, 'getCitationByWordCount']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/citations', [CitationController::class, 'storeCitation']);
    Route::get("categories", [CategoryController::class, "getAllCategories"]);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::put('/citations/{citation}', [CitationController::class, 'updateCitation'])->middleware("user_permissions")->middleware("admin_permissions");
    Route::delete('/citations/{citation}', [CitationController::class, 'destroyCitation'])->middleware("user_permissions")->middleware("admin_permissions");
});


Route::middleware(["auth:sanctum", "admin_permissions"])->group(function () {

    Route::post("categories", [CategoryController::class, "store"]);
    Route::get("categories/{category}", [CategoryController::class, "show"]);
    Route::put("categories/{category}", [CategoryController::class, "update"]);
    Route::delete("categories/{category}", [CategoryController::class, "destroy"]);


    Route::get("tags", [TagController::class, "getAllTags"]);
    Route::post("tags", [TagController::class, "store"]);
    Route::get("tags/{tag}", [TagController::class, "show"]);
    Route::put("tags/{tag}", [TagController::class, "update"]);
    Route::delete("tags/{tag}", [TagController::class, "destroy"]);

    Route::patch('/citations/{citation}/approve', [CitationController::class, 'approveByAdmin']);
});
