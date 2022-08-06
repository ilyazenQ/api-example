<?php

use App\Http\Controllers\HHController;
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
Route::group(['prefix' => 'posts'], function () {
    Route::post('create', [PostController::class, 'create'])->name('createPost');
    Route::get('{id}', [PostController::class, 'get'])->name('getPost');
    Route::post('', [PostController::class, 'getAll'])->name('getAllPost');
    Route::delete('{id}', [PostController::class, 'delete'])->name('deletePost');
    Route::patch('{id}', [PostController::class, 'patch'])->name('patchPost');
    Route::post('posts:search', [PostController::class, 'search'])->name('searchPost');
});

Route::get('getEmployer',[HHController::class,'getEmployer'])->name('getEmployer');
Route::post('suggests:search', [PostController::class, 'searchByElastic'])->name('searchByElastic');;
