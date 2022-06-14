<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\ClassVideoController;

Route::prefix('admin')->middleware('theme:admin')->name('admin.')->group(function(){
    Route::view('/login' , 'auth.login')->name('login'); // Show Login From For Admin
    Route::post('/login', [AuthController::class , 'login_Admin'])->name('auth.login'); // Admin Login
    Route::view('/registration', 'auth.register')->name('register'); // Show Registration From 

    Route::middleware(['auth:admin'])->group(function(){
        Route::get('/dashboard', [HomeController::class , 'show'])->name('dashboard'); // Show Dashboard Page;
        Route::post('/logout', [AuthController::class , 'logout'])->name('logout');
        Route::view('/class-video-add-form' , 'pages.class-video-add-form')->name('class-video-add-form');
        Route::post('/class-video-add' , [ClassVideoController::class , 'store'])->name('class-video-add');
        Route::get('/all-videos',[ClassVideoController::class , "show"])->name('all-videos');
    });

    Route::post('/registration', [AuthController::class , 'admin_registration'])->name('auth.register'); // Register as a Admin
});

