<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SopirController;
use App\Http\Controllers\TrackingController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('users', UserController::class);
    Route::resource('bookings', BookingController::class);
    Route::resource('history', HistoryController::class);
    Route::resource('cars', CarController::class);
    Route::resource('sopirs', SopirController::class);
    // Route::resource('trackings', TrackingController::class);

    Route::post('bookings/{id}/approve', [BookingController::class, 'approve'])->name('bookings.approve');
    Route::delete('bookings/{id}/reject', [BookingController::class, 'reject'])->name('bookings.reject');
    
    // Route::get('/track', [TrackingController::class, 'trek'])->name('trek');
    Route::get('/export', [HistoryController::class, 'cetak'])->name('cetak'); 
    Route::get('/export/pdf', [HistoryController::class, 'cetakPdf'])->name('cetak.pdf');
});


require __DIR__.'/auth.php';
