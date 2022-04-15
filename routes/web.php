<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
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

    Route::resource('/articles', ArticleController::class);
    Route::resource('/categories', CategoryController::class)->except(['show'])->middleware('auth.superadmin');

    Route::delete('/sign-out', [AuthController::class, 'logout'])->name('signOut');
});

Route::middleware('guest')->group(function () {
    Route::get('/sign-in', [AuthController::class, 'index'])->name('signIn');
    Route::post('/sign-in', [AuthController::class, 'authenticate']);
});
