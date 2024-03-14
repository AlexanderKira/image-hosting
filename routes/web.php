<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Image\ImageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('page.home');
Route::post('/', [ImageController::class, 'store'])->name('image.store');
Route::post('{image}/download', [ImageController::class, 'download'])->name('image.download');
Route::post('{image}/delete', [ImageController::class, 'delete'])->name('image.delete');


