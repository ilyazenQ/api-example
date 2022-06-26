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
Route::delete('posts/{id}', [PostController::class, 'delete'])->name('deletePost');
Route::put('posts/{id}', [PostController::class, 'put'])->name('putPost');
Route::post('posts:search', [PostController::class, 'search']);
