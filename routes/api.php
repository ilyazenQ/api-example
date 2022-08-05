<?php

use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('posts/create', [PostController::class, 'create'])->name('createPost');
Route::get('posts/{id}', [PostController::class, 'get'])->name('getPost');
Route::get('posts', [PostController::class, 'getAll'])->name('getAllPost');
Route::delete('posts/{id}', [PostController::class, 'delete'])->name('deletePost');
Route::patch('posts/{id}', [PostController::class, 'patch'])->name('patchPost');
Route::post('posts:search', [PostController::class, 'search'])->name('searchPost');

Route::post('suggests:search', [PostController::class, 'searchByElastic'])->name('searchByElastic');;
