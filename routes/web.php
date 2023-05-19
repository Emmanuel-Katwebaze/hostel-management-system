<?php

use App\Http\Controllers\BedController;
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


use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\FacilitiesController;
use App\Http\Controllers\GuestBookingController;
use App\Http\Controllers\HostelBookingController;
use App\Http\Controllers\HostelRoomController;
use App\Http\Controllers\HostelRoomTypeController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\MtnMomoPaymentController;
use App\Http\Controllers\StripePaymentController;

Route::get('/', function () {
    return redirect('home');
})->middleware('guest');
Route::get('/home', [LandingPageController::class, 'index'])->middleware('guest');
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
Route::prefix('hostel-rooms')->middleware(['auth', 'admin'])->group(function () {
    Route::get('', [HostelRoomController::class, 'index'])->name('hostel-room');
    Route::get('create', [HostelRoomController::class, 'create'])->name('hostel-rooms.create');
    Route::get('{id}', [HostelRoomController::class, 'show'])->name('hostel-room.show');
    Route::post('create', [HostelRoomController::class, 'store']);
    Route::get('{id}/edit', [HostelRoomController::class, 'edit'])->name('hostel-room.edit');
    Route::delete('{id}', [HostelRoomController::class, 'destroy'])->name('hostel-room.destroy');
    Route::put('{id}', [HostelRoomController::class, 'update'])->name('hostel-room.update');
});



//Hostel Room Types/Categories
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('categories', [HostelRoomTypeController::class, 'index'])->name('hostel-room-categories');
    Route::get('categories/create', [HostelRoomTypeController::class, 'create'])->name('hostel-room-categories.create');
    Route::get('categories/{id}', [HostelRoomTypeController::class, 'show'])->name('hostel-room-categories.show');
    Route::get('categories/{id}/create', [HostelRoomTypeController::class, 'category_create'])->name('hostel-room-categories.category_create');
    Route::post('categories/{id}/create', [HostelRoomTypeController::class, 'category_store'])->name('hostel-room-categories.category_store');
    Route::post('categories/create', [HostelRoomTypeController::class, 'store']);
    Route::get('categories/{id}/edit', [HostelRoomTypeController::class, 'edit'])->name('hostel-room-categories.edit');
    Route::delete('categories/{id}', [HostelRoomTypeController::class, 'destroy'])->name('hostel-room-categories.destroy');
    Route::put('categories/{id}', [HostelRoomTypeController::class, 'update'])->name('hostel-room-categories.update');
});


// Staff Routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('staff', [StaffController::class, 'index'])->name('staff');
    Route::get('staff/create', [StaffController::class, 'create'])->name('staff.create');
    Route::post('staff/create', [StaffController::class, 'store']);
    Route::get('staff/{id}/edit', [StaffController::class, 'edit'])->name('staff.edit');
    Route::delete('staff/{id}', [StaffController::class, 'destroy'])->name('staff.destroy');
    Route::put('staff/{id}', [StaffController::class, 'update'])->name('staff.update');
});



// Tenant Routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('tenant', [TenantController::class, 'index'])->name('tenant');
    Route::get('tenant/create', [TenantController::class, 'create'])->name('tenant.create');
    Route::post('tenant/create', [TenantController::class, 'store']);
    Route::get('tenant/{id}/edit', [TenantController::class, 'edit'])->name('tenant.edit');
    Route::delete('tenant/{id}', [TenantController::class, 'destroy'])->name('tenant.destroy');
    Route::put('tenant/{id}', [TenantController::class, 'update'])->name('tenant.update');
});


// hostel_booking Routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('hostel_booking', [HostelBookingController::class, 'index'])->name('hostel_booking');
    Route::get('hostel_booking/select-category', [HostelBookingController::class, 'select_category'])->name('hostel_booking.select-category');
    Route::get('hostel_booking/{id}', [HostelBookingController::class, 'show'])->name('hostel_booking.show');
    Route::get('hostel_booking/{category}/select-room', [HostelBookingController::class, 'select_room'])->name('hostel_booking.select-room');
    Route::get('hostel_booking/{category}/select-room/{id}/create', [HostelBookingController::class, 'create'])->name('hostel_booking.create');
    Route::post('hostel_booking/{category}/select-room/{id}/create', [HostelBookingController::class, 'store']);
    Route::get('hostel_booking/{id}/edit', [HostelBookingController::class, 'edit'])->name('hostel_booking.edit');
    Route::delete('hostel_booking/{id}', [HostelBookingController::class, 'destroy'])->name('hostel_booking.destroy');
    Route::put('hostel_booking/{id}', [HostelBookingController::class, 'update'])->name('hostel_booking.update');
});

// facilities routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('facilities', [FacilitiesController::class, 'index'])->name('facilities');
    Route::get('facilities/create', [FacilitiesController::class, 'create'])->name('facilities.create');
    Route::post('facilities/create', [FacilitiesController::class, 'store']);
    Route::get('facilities/show/{id}', [FacilitiesController::class, 'show'])->name('facilities.show');
    Route::get('facilities/{id}/edit', [FacilitiesController::class, 'edit'])->name('facilities.edit');
    Route::post('facilities/store', [FacilitiesController::class, 'store'])->name('facilities.store');
    Route::delete('facilities/{id}', [FacilitiesController::class, 'destroy'])->name('facilities.destroy');
    Route::put('facilities/{id}', [FacilitiesController::class, 'update'])->name('facilities.update');
});

// Expenses routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('expenses', [ExpensesController::class, 'index'])->name('expenses');
    Route::get('expenses/create', [ExpensesController::class, 'create'])->name('expenses.create');
    Route::post('expenses/create', [ExpensesController::class, 'store']);
    Route::get('expenses/show/{id}', [ExpensesController::class, 'show'])->name('expenses.show');
    Route::get('expenses/{id}/edit', [ExpensesController::class, 'edit'])->name('expenses.edit');
    Route::delete('expenses/{id}', [ExpensesController::class, 'destroy'])->name('expenses.destroy');
    Route::put('expenses/{id}', [ExpensesController::class, 'update'])->name('expenses.update');
});

//Admin Guest routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('guest-booking', [GuestBookingController::class, 'index'])->name('guest-booking');
    Route::get('guest-booking/select-category', [GuestBookingController::class, 'select_category'])->name('guest-booking.select-category');
    Route::get('guest-booking/{category}/select-room', [GuestBookingController::class, 'select_room'])->name('guest-booking.select-room');
    Route::get('guest-booking/{category}/select-room/{id}/create', [GuestBookingController::class, 'create'])->name('guest-booking.create');
    Route::post('guest-booking/{category}/select-room/{id}/create', [GuestBookingController::class, 'store']);
    Route::get('guest-booking/show/{id}', [GuestBookingController::class, 'show'])->name('guest-booking.show');
    Route::get('guest-booking/{id}/edit', [GuestBookingController::class, 'edit'])->name('guest-booking.edit');
    Route::delete('guest-booking/{id}', [GuestBookingController::class, 'destroy'])->name('guest-booking.destroy');
    Route::put('guest-booking/{id}', [GuestBookingController::class, 'update'])->name('guest-booking.update');
});



//Guest Routes
Route::middleware('auth')->group(function () {
    Route::get('guest', [GuestController::class, 'index'])->name('guest');
    Route::get('guest/{id}/create', [GuestController::class, 'create'])->name('guestBooking.create');
    Route::post('guest/{id}/create', [GuestController::class, 'store'])->name('guestBooking.create');
    Route::get('guest/booking/{id}', [GuestController::class, 'show'])->name('guestBooking.show');
    Route::get('guest/bookings', [GuestController::class, 'getBookings'])->name('guestBookings');
    Route::delete('guest/bookings/{id}', [GuestController::class, 'destroy'])->name('guestBookings.destroy');
});

//Payments
Route::middleware('auth')->group(function () {
    Route::get('stripe', [StripePaymentController::class, 'paymentStripe'])->name('addmoney.paymentstripe');
    Route::post('pay', [StripePaymentController::class, 'pay'])->name('pay');
    Route::post('add-money-stripe', [StripePaymentController::class, 'postPaymentStripe'])->name('addmoney.stripe');
    Route::get('mtn', [MtnMomoPaymentController::class, 'paymentMTN'])->name('addmoney.paymentsMtn');
    Route::post('mtn-pay', [MtnMomoPaymentController::class, 'pay'])->name('mtn-pay');
    Route::post('add-money-mtn', [MtnMomoPaymentController::class, 'postPaymentMTN'])->name('addmoney.mtn');
});

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
