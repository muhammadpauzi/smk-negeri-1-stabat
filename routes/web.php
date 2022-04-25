<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\Public\ArticleController as PublicArticleController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\MajorController as PublicMajorController;
use App\Http\Controllers\Public\SchoolProfileController as PublicSchoolProfileController;
use App\Http\Controllers\SchoolProfileController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// roles & permissions
// superadmin: can all (users, articles, categories, students, teachers, majors)
// admin: can all (articles, categories, students, teachers, majors)
// editor: can only (articles)

Route::prefix('/')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    Route::get('/articles/{article}', [PublicArticleController::class, 'show'])->name('articles.show');
    Route::get('/school-profile', [PublicSchoolProfileController::class, 'index'])->name('school-profile.index');
    Route::get('/majors/{major}', [PublicMajorController::class, 'show'])->name('majors.show');
});

Route::middleware('auth')->group(function () {
    Route::prefix('/dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');


        Route::middleware(['role:superadmin,admin,editor'])->group(function () {
            Route::resource('/articles', ArticleController::class)->except(['index', 'show']);
        });

        Route::middleware(['role:superadmin,admin'])->group(function () {
            Route::resource('/categories', CategoryController::class)->except(['index', 'show']);
            Route::resource('/majors', MajorController::class)->except(['index', 'show']);
            Route::resource('/teachers', TeacherController::class)->except(['index', 'show']);
            Route::resource('/students', StudentController::class)->except(['index', 'show']);
            Route::resource('/slides', SlideController::class)->except(['index', 'show']);
            Route::resource('/menus', MenuController::class)->except(['index', 'show']);

            Route::get('/school-profile/edit', [SchoolProfileController::class, 'edit'])->name('school-profile.edit');
            Route::put('/school-profile/edit', [SchoolProfileController::class, 'update'])->name('school-profile.update');
        });

        Route::middleware('role:superadmin')->group(function () {
            Route::resource('/users', UserController::class);
        });

        Route::get('/school-profile', [SchoolProfileController::class, 'index'])->name('school-profile.index');

        Route::get('/menus', [MenuController::class, 'index'])->name('menus.index');

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
    });
    Route::delete('/sign-out', [AuthController::class, 'logout'])->name('signOut');
});

Route::middleware('guest')->group(function () {
    Route::get('/sign-in', [AuthController::class, 'index'])->name('signIn');
    Route::post('/sign-in', [AuthController::class, 'authenticate']);
});
