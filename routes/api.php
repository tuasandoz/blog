<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/post', [PostController::class, 'index']);
Route::post('/post/tambah', [PostController::class, 'store']);
Route::post('/post/update/{id}', [PostController::class, 'update']);
Route::get('/post/detail/{id}', [PostController::class, 'detail']);
Route::delete('/post/delete/{id}', [PostController::class, 'delete']);

Route::get('/category', [CategoryController::class, 'index']);
Route::post('/category/tambah', [CategoryController::class, 'store']);
Route::post('/category/update/{id}', [CategoryController::class, 'update']);
Route::get('/category/detail/{id}', [CategoryController::class, 'detail']);
Route::delete('/category/delete/{id}', [CategoryController::class, 'delete']);

Route::get('/tag', [TagController::class, 'index']);
Route::post('/tag/tambah', [TagController::class, 'store']);
Route::post('/tag/update/{id}', [TagController::class, 'update']);
Route::get('/tag/detail/{id}', [TagController::class, 'detail']);
Route::delete('/tag/delete/{id}', [TagController::class, 'delete']);
