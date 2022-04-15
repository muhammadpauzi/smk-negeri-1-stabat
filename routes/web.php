<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');



    Route::prefix('/articles')->group(function () {
        Route::get('/', [ArticleController::class, 'index'])
            ->name('articles');

        Route::get('/create', [ArticleController::class, 'create'])
            ->name('articles.create');
        Route::post('/create', [ArticleController::class, 'store']);


        Route::delete('/{article:slug}', [ArticleController::class, 'destroy'])
            ->name('articles.delete');

        Route::get('/{article:slug}/edit', [ArticleController::class, 'edit'])
            ->name('articles.update');
        Route::put('/{article:slug}/edit', [ArticleController::class, 'update']);

        Route::get('/{article:slug}', [ArticleController::class, 'show'])
            ->name('articles.show');
    });

    Route::delete('/sign-out', [AuthController::class, 'logout'])->name('signOut');
});

Route::middleware('guest')->group(function () {
    Route::get('/sign-in', [AuthController::class, 'index'])->name('signIn');
    Route::post('/sign-in', [AuthController::class, 'authenticate']);
});
