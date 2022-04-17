<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
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

// roles & permissions
// superadmin: can all (users, articles, categories, students, teachers, majors)
// admin: can all (articles, categories, students, teachers, majors)
// editor: can only (articles)

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');


    Route::middleware(['role:superadmin,admin,editor'])->group(function () {
        Route::resource('/articles', ArticleController::class)->except(['index', 'show']);
    });

    Route::middleware(['role:superadmin,admin'])->group(function () {
        Route::resource('/categories', CategoryController::class)->except(['index', 'show']);
        Route::resource('/majors', MajorController::class)->except(['index', 'show']);
        Route::resource('/teachers', TeacherController::class)->except(['index', 'show']);
        Route::resource('/students', StudentController::class)->except(['index', 'show']);
        Route::resource('/slides', SlideController::class)->except(['index', 'show']);
    });

    Route::middleware('role:superadmin')->group(function () {
        Route::resource('/users', UserController::class);
    });

    Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

    Route::get('/slides', [SlideController::class, 'index'])->name('slides.index');
    Route::get('/slides/{slide}', [SlideController::class, 'show'])->name('slides.show');

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
