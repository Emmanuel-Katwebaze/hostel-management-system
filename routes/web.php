<?php

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

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HostelRoomController;
use App\Http\Controllers\HostelRoomTypeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\StaffController;

Route::get('/', function () {return redirect('sign-in');})->middleware('guest');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('sign-up', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('sign-up', [RegisterController::class, 'store'])->middleware('guest');
Route::get('sign-in', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('sign-in', [SessionsController::class, 'store'])->middleware('guest');
Route::post('verify', [SessionsController::class, 'show'])->middleware('guest');
Route::post('reset-password', [SessionsController::class, 'update'])->middleware('guest')->name('password.update');
Route::get('verify', function () {
	return view('sessions.password.verify');
})->middleware('guest')->name('verify');
Route::get('/reset-password/{token}', function ($token) {
	return view('sessions.password.reset', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('sign-out', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');
Route::get('profile', [ProfileController::class, 'create'])->middleware('auth')->name('profile');
Route::post('user-profile', [ProfileController::class, 'update'])->middleware('auth');

//Hostel Room Routes
Route::get('hostel-rooms', [HostelRoomController::class, 'index'])->middleware('auth')->name('hostel-room');
Route::get('hostel-rooms/create', [HostelRoomController::class, 'create'])->middleware('auth')->name('hostel-rooms.create');
Route::get('hostel-rooms/{id}', [HostelRoomController::class, 'show'])->middleware('auth')->name('hostel-room.show');
Route::post('hostel-rooms/create', [HostelRoomController::class, 'store'])->middleware('auth');
Route::get('hostel-rooms/{id}/edit', [HostelRoomController::class, 'edit'])->middleware('auth')->name('hostel-room.edit');
Route::delete('hostel-rooms/{id}', [HostelRoomController::class, 'destroy'])->middleware('auth')->name('hostel-room.destroy');
Route::put('hostel-rooms/{id}', [HostelRoomController::class, 'update'])->middleware('auth')->name('hostel-room.update');


//Hostel Room Types/Categories
Route::get('categories', [HostelRoomTypeController::class, 'index'])->middleware('auth')->name('hostel-room-categories');
Route::get('categories/create', [HostelRoomTypeController::class, 'create'])->middleware('auth')->name('hostel-room-categories.create');
Route::get('categories/{id}', [HostelRoomTypeController::class, 'show'])->middleware('auth')->name('hostel-room-categories.show');
Route::get('categories/{id}/create', [HostelRoomTypeController::class, 'category_create'])->middleware('auth')->name('hostel-room-categories.category_create');
Route::post('categories/{id}/create', [HostelRoomTypeController::class, 'category_store'])->middleware('auth')->name('hostel-room-categories.category_store');
Route::post('categories/create', [HostelRoomTypeController::class, 'store'])->middleware('auth');
Route::get('categories/{id}/edit', [HostelRoomTypeController::class, 'edit'])->middleware('auth')->name('hostel-room-categories.edit');
Route::delete('categories/{id}', [HostelRoomTypeController::class, 'destroy'])->middleware('auth')->name('hostel-room-categories.destroy');
Route::put('categories/{id}', [HostelRoomTypeController::class, 'update'])->middleware('auth')->name('hostel-room-categories.update');

// Staff Routes
Route::get('staff', [StaffController::class, 'index'])->middleware('auth')->name('staff');
Route::get('staff/create', [StaffController::class, 'create'])->middleware('auth')->name('staff.create');
Route::post('staff/create', [StaffController::class, 'store'])->middleware('auth');
Route::get('staff/{id}/edit', [StaffController::class, 'edit'])->middleware('auth')->name('staff.edit');
Route::delete('staff/{id}', [StaffController::class, 'destroy'])->middleware('auth')->name('staff.destroy');
Route::put('staff/{id}', [StaffController::class, 'update'])->middleware('auth')->name('staff.update');

//General Page Routes
Route::group(['middleware' => 'auth'], function () {
	Route::get('tables', function () {
		return view('pages.tables');
	})->name('tables');
	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');
	Route::get('static-sign-in', function () {
		return view('pages.static-sign-in');
	})->name('static-sign-in');
	Route::get('static-sign-up', function () {
		return view('pages.static-sign-up');
	})->name('static-sign-up');
	Route::get('user-management', function () {
		return view('pages.laravel-examples.user-management');
	})->name('user-management');
	Route::get('user-profile', function () {
		return view('pages.laravel-examples.user-profile');
	})->name('user-profile');
});
