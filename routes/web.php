<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
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

    Route::middleware('auth.superadmin')->group(function () {
        Route::resource('/categories', CategoryController::class)->except(['index', 'show']);
        Route::resource('/majors', MajorController::class)->except(['index', 'show']);
        Route::resource('/teachers', TeacherController::class)->except(['index', 'show']);
        Route::resource('/students', StudentController::class)->except(['index', 'show']);
    });

    // for public (editor, superadmin and all) to see major detail page
    Route::get('/majors', [MajorController::class, 'index'])->name('majors.index');
    Route::get('/majors/{major}', [MajorController::class, 'show'])->name('majors.show');

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

    Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');
    Route::get('/teachers/{teacher}', [TeacherController::class, 'show'])->name('teachers.show');

    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    Route::get('/students/{student}', [StudentController::class, 'show'])->name('students.show');

    Route::delete('/sign-out', [AuthController::class, 'logout'])->name('signOut');
});

Route::middleware('guest')->group(function () {
    Route::get('/sign-in', [AuthController::class, 'index'])->name('signIn');
    Route::post('/sign-in', [AuthController::class, 'authenticate']);
});
