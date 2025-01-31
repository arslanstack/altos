<?php

use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkorderController;
use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/migrate', function () {
    Artisan::call('migrate');
})->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/workorders', [WorkorderController::class, 'index'])->name('workorders.index');
    Route::get('/create-zip/{id}', [FileUploadController::class, 'zipper'])->name('uploads.createZip');
    Route::get('/upload-files/{id}', [FileUploadController::class, 'index'])->name('upload-files');
    Route::post('/file-upload', [FileUploadController::class, 'upload'])->name('fileuploadem');
    Route::get('/workorders/create', [WorkorderController::class, 'create'])->name('workorders.create');
    Route::post('/workorders', [WorkorderController::class, 'store'])->name('workorders.store');
    Route::get('/workorders/{workorder}', [WorkorderController::class, 'show'])->name('workorders.show');
    Route::get('/workorders/{workorder}/edit', [WorkorderController::class, 'edit'])->name('workorders.edit');
    Route::put('/workorders/{workorder}', [WorkorderController::class, 'update'])->name('workorders.update');
    Route::delete('/workorders/{workorder}', [WorkorderController::class, 'destroy'])->name('workorders.destroy');
});

Route::post('/upload', [FileUploadController::class, 'upload'])->name('upload');
Route::get('/upload', function () {
    return view('upload');
});

require __DIR__ . '/auth.php';
