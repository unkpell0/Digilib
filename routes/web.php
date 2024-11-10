<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AdminController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/coba', function () {
    return view('cobahome');
});


// Route::prefix('/admin')->group(function () {
//     Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
// Route::get('/book', [AdminController::class, 'book'])->name('admin.book.index');
//     Route::get('/transaction', [AdminController::class, 'transaction'])->name('admin.transaction');
//     Route::get('/comment', [AdminController::class, 'comment'])->name('admin.comment');
//     Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');
// });

Route::get('/admin', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');


// Route::prefix('admin')->name('admin.')->group(function () {
//     Route::resource('book', BookController::class);
// });

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Book Routes with resource
    Route::resource('book', BookController::class)->names([
        'index' => 'book.index',
        'create' => 'book.add',
        'store' => 'book.store',
        'show' => 'book.show',
        'edit' => 'book.edit',
        'update' => 'book.update',
        'destroy' => 'book.destroy',
    ]);
});