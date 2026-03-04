<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/dashboard', [UserController::class,'index'] )->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('admin')->group(function () {
    //category routes
    Route::get('/add_category', [AdminController::class,'add_category'])->name('admin.add_category');
    Route::post('/add_category', [AdminController::class,'post_addcategory'])->name('admin.post_addcategory');
    Route::get('/view_categories', [AdminController::class,'view_categories'])->name('admin.view_category');
    Route::get('/delete_category/{id}', [AdminController::class,'delete_category'])->name('admin.delete_category');
    Route::get('/update_category/{id}', [AdminController::class,'edit_category'])->name('admin.update_category');
    Route::post('/update_category/{id}', [AdminController::class,'post_editcategory'])->name('admin.post_update_category');

    //product routes
    Route::get('/add_product', [AdminController::class,'add_product'])->name('admin.add_product');
    Route::post('/add_product', [AdminController::class,'post_add_product'])->name('admin.post_add_product');
    Route::get('/view_products', [AdminController::class,'view_products'])->name('admin.view_product');
    Route::get('/delete_product/{id}', [AdminController::class,'delete_product'])->name('admin.delete_product');
    Route::get('/update_product/{id}', [AdminController::class,'update_product'])->name('admin.update_product');
    Route::post('/update_product/{id}', [AdminController::class,'post_edit_product'])->name('admin.post_edit_product');
});

require __DIR__.'/auth.php';
