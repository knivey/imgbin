<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\IndexController;
use \App\Http\Controllers\ImageController;
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



Route::get("/", IndexController::class)->name("gallery");
Route::get("/image/{image:shortid}", [ImageController::class, 'viewImage'])->name("viewImage");
Route::get("/i/{image:shortid}", [ImageController::class, 'hotImage'])->name("hotImage");
Route::get("/images/{user:name}", [ImageController::class, 'userImages'])->name("userImages");

Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::get('/new', [ImageController::class, 'new'])->name('new');
    Route::post('/upload', [ImageController::class, 'upload'])->name('upload');
    Route::post('/delete-image/{image}', [ImageController::class, 'destroy'])->name('deleteImage');
});


