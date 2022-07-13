<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\ClassVideoController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\McqController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuccessPeopleController;

Route::prefix('admin')->middleware('theme:admin')->name('admin.')->group(function(){
    Route::view('/login' , 'auth.login')->name('login'); // Show Login From For Admin
    Route::post('/login', [AuthController::class , 'login_Admin'])->name('auth.login'); // Admin Login
    // Route::view('/registration', 'auth.register')->name('register'); // Show Registration From

    Route::middleware(['auth:admin'])->group(function(){
        Route::get('/dashboard', [HomeController::class , 'show'])->name('dashboard'); // Show Dashboard Page;
        Route::post('/logout', [AuthController::class , 'logout'])->name('logout');
        Route::view('/class-video-add-form' , 'pages.class-video-add-form')->name('class-video-add-form');
        Route::post('/class-video-add' , [ClassVideoController::class , 'store'])->name('class-video-add');
        Route::get('/all-videos',[ClassVideoController::class , "show"])->name('all-videos');
        Route::get('/free-videos',[ClassVideoController::class , "freeVideosShow"])->name('free-videos');
        Route::get('/live-class-videos',[ClassVideoController::class , "liveClassVidoesShow"])->name('live-class-videos');
        Route::get('/video-edit-form/{encrypt_id}',[ClassVideoController::class , "edit"])->name('class-video-edit-form');
        Route::post('/video-edit/{encrypt_id}',[ClassVideoController::class , "update"])->name('class-video.edit');
        Route::post('/video-delete/{encrypt_id}',[ClassVideoController::class , "destroy"])->name('class-video.delete');
        Route::get('/class-video/instruction',[ClassVideoController::class,'instruction'])->name('class-video.instruction');
        Route::get('/class-video/instruction/edit-from',[ClassVideoController::class,'instructionEdit'])->name('instruction.edit-form');
        Route::put('/class-video/instruction/edit/{encrypt_id}',[ClassVideoController::class,'instructionUpdate'])->name('instruction.edit');

        // Management Tab
        Route::prefix('management')->group(function(){
            Route::get('users',[ManagementController::class,'userShow'])->name('users-list');
            Route::get('users/status/change/{encrypt_id}',[ManagementController::class,'userStatusChange'])->name('user.status.change');
            Route::post('users/delete/{encrypt_id}',[ManagementController::class,'destroy'])->name('user.delete');
        });

        // Products
        Route::prefix('products')->name('product.')->group(function(){
            Route::get('/all-products',[ProductController::class,'index'])->name('all');
            Route::get('/add-form',[ProductController::class,'show'])->name('add-form');
            Route::post('/add',[ProductController::class,'store'])->name('add');
            Route::get('/edit-form/{encrypt_id}',[ProductController::class,'edit'])->name('edit-form');
            Route::post('/edit/{encrypt_id}',[ProductController::class,'update'])->name('update');
            Route::post('/delete/{encrypt_id}',[ProductController::class,'destroy'])->name('delete');
        });

        // Category
        Route::prefix('category')->name('category.')->group(function(){
            Route::get('/all-categories',[ProductController::class,'shawCategories'])->name('all');
            Route::view('/add-form','category.add-form')->name('add-form');
            Route::post('/add',[ProductController::class,'categoryStore'])->name('add');
            Route::get('/edit-form/{encrypt_id}',[ProductController::class,'categoryEditFormShow'])->name('edit-form');
            Route::post('/update/{encrypt_id}',[ProductController::class,'categoryUpdate'])->name('update');
            Route::post('/delete/{encrypt_id}',[ProductController::class,'categoryDelete'])->name('destroy');
        });

        // Profile
        Route::prefix('profile')->name('profile.')->group(function(){
            Route::view('/view','profile.profile')->name('view');
            Route::post('/password/change',[ProfileController::class,'passwordUpdate'])->name('password.update');
            Route::put('/update/information',[ProfileController::class,'update'])->name('update.information');
        });

        // Success People
        Route::prefix('success-people')->name('success.people.')->group(function(){
            Route::get('/list',[SuccessPeopleController::class,'index'])->name('list');
            Route::view('/add-form','success-people.success-people-add-form')->name('add-form');
            Route::post('/add',[SuccessPeopleController::class,'store'])->name('add');
            Route::post('/delete/{encrypt_id}',[SuccessPeopleController::class,'destroy'])->name('delete');
            Route::get('/edit-form/{encrypt_id}',[SuccessPeopleController::class,'edit'])->name('edit-form');
            Route::put('/edit/{encrypt_id}',[SuccessPeopleController::class,'update'])->name('edit');
        });

        // MCQ 
        Route::prefix('mcq')->name('mcq.')->group(function(){
            Route::get('/add-from',[McqController::class,'create'])->name('add-form');
            Route::post('/add',[McqController::class,'store'])->name('add');
            Route::get('/list',[McqController::class,'index'])->name('list');
            Route::get('/edit-from/{encrypt_id}',[McqController::class,'edit'])->name('edit-form');
            Route::put('/edit/{encrypt_id}',[McqController::class,'update'])->name('edit');
            Route::post('/delete/{encrypt_id}',[McqController::class,'destroy'])->name('delete');
        });

        // About Us
        Route::get('/about-us',[HomeController::class,'aboutUsIndex'])->name('about.us');
        Route::get('/about-us/edit-form',[HomeController::class,'aboutUsEdit'])->name('about-us.edit-form');
        Route::put('/about-us/edit',[HomeController::class,'aboutUsUpdate'])->name('about-us.edit');

        // Class 
        Route::view('/class/add-form','class.class-add-form')->name('class.add-form');
        Route::post('/class/add',[HomeController::class,'classAdd'])->name('class.add');
        Route::get('/class/list',[HomeController::class,'classList'])->name('class.list');
        Route::get('/class/edit-from/{encrypt_id}',[HomeController::class,'classEdit'])->name('class.edit-form');
        Route::put('/class/edit/{encrypt_id}',[HomeController::class,'classUpdate'])->name('class.edit');
        Route::post('/class/delete/{encrypt_id}',[HomeController::class,'classDestroy'])->name('class.delete');


        // Order Created
        Route::prefix('order')->name('order.')->group(function(){
            Route::get('/create',[OrderController::class,'create'])->name('create');
            Route::post('/get-product-info',[OrderController::class,'getProductInfo']);
            Route::post('/add',[OrderController::class,'store'])->name('add');
            Route::get('/list',[OrderController::class,'index'])->name('list');
            Route::get('/edit-form/{encrypt_id}',[OrderController::class,'edit'])->name('edit-form');
            Route::post('/edit/{encrypt_id}',[OrderController::class,'update'])->name('edit');
            Route::get('/hold/{encrypt_id}',[OrderController::class,'markAsHold'])->name('hold');
            Route::get('/complete/{encrypt_id}',[OrderController::class,'markAsComplete'])->name('complete');
            Route::post('/delete/{encrypt_id}',[OrderController::class,'destroy'])->name('delete');
            Route::get('/complete-list',[OrderController::class,'completeOrders'])->name('complete-list');
            Route::get('/complete/view/{encrypt_id}',[OrderController::class,'completeOrderView'])->name('complete-view');
        });

    });

    Route::post('/registration', [AuthController::class , 'admin_registration'])->name('auth.register'); // Register as a Admin
});

