<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;

Route::get('/', [ContactController::class, 'index'])->name('contact.index');
Route::post('/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');
Route::post('/thanks', [ContactController::class, 'store'])->name('contact.store');

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('/search', [AdminController::class, 'search'])->name('admin.search');
Route::get('/reset', [AdminController::class, 'reset'])->name('admin.reset');
Route::post('/delete', [AdminController::class, 'delete'])->name('admin.delete');
Route::get('/export', [AdminController::class, 'export'])->name('admin.export');