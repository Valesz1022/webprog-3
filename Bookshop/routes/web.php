<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\OrderController;
use App\Http\Middleware\AdminRoleMiddleware;
use App\Http\Middleware\UserRoleMiddleware;


    Route::get('/', function () {
        return view('auth.login');
    });

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);


Route::middleware('auth')->group(function () {

    Route::get('/books', [BookController::class, 'index'])->name('books');

    Route::middleware([UserRoleMiddleware::class])->group(function () {
        
        Route::get('/home', [HomeController::class, 'index'])->name('home');

        Route::get('/my_orders', [OrderController::class, 'myOrders'])->name('my_orders');

        Route::get('/shop', [OrderController::class, 'index'])->name('shop');
        Route::post('/place-order', [OrderController::class, 'placeOrder'])->name('place.order');

        Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('my_orders');

        Route::get('/profile', [UserProfileController::class, 'edit'])->name('profile');
        Route::put('/profile/update', [UserProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [UserProfileController::class, 'destroy'])->name('profile.destroy');

    });

    Route::middleware([AdminRoleMiddleware::class])->group(function () {

        Route::get('/add_book', function () {
            return view('add_book');
        })->name('add_book');
        Route::post('/books', [BookController::class, 'uploadBook'])->name('upload.book');

        Route::get('/delete_books', [BookController::class, 'deleteBooks'])->name('delete_books');
        Route::delete('/delete_book/{book}', [BookController::class, 'delete'])->name('delete_book');

        Route::get('/update_book', [BookController::class, 'showUpdateForm'])->name('show_update_form');
        Route::post('/update_book', [BookController::class, 'update'])->name('update_books');

        Route::get('adminorders', [OrderController::class, 'adminOrders'])->name('adminorders');
        Route::post('adminorders/update-status', [OrderController::class, 'updateStatus'])->name('admin.orders.update_status');
        Route::post('adminorders/delete', [OrderController::class, 'deleteOrder'])->name('admin.orders.delete');

        Route::get('/users', [UserController::class, 'index'])->name('users');

    });

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

