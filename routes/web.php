<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Vendor\VendorController;

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
    return view('frontend/index');
});

Route::controller(MainController::class)->group(function () {
    Route::get('/user-registration','userRegistration')->name('userRegistration');
    Route::get('/user-login','userLogin')->name('userLogin');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
// admin routes
Route::middleware(['auth','role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('/dashboard','dashboard')->name('dashboard');
    });
});
// vendor routes
Route::middleware(['auth','role:vendor'])->prefix('vendor')->name('vendor.')->group(function () {
    Route::controller(VendorController::class)->group(function () {
        Route::get('/dashboard','dashboard')->name('dashboard');
    });
    
});
// user routes
Route::middleware(['auth','role:user'])->prefix('user')->name('user.')->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('/dashboard','dashboard')->name('dashboard');
    });
    
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
