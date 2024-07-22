<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Frontend\HomepageController;
use App\Http\Controllers\Frontend\CarController;
use App\Http\Controllers\Frontend\MotoController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\FeedbackController;
use App\Http\Controllers\Frontend\BookingController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\Frontend\PasswordController;
use App\Http\Controllers\Frontend\HistoryController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\SearchController;
use App\Models\Type;
use App\Models\TypeMotorcycle;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\AdminController;

Route::get('/', [HomepageController::class, 'index'])->name('homepage');

Route::get('/cari-kendaraan', [SearchController::class, 'cari'])->name('cari-kendaraan');

Route::get('car/categories', function () {
    return Type::all(['id', 'nama'])->toArray();
})->name('car.categories');

Route::get('motor/categories', function () {
    return TypeMotorcycle::all(['id', 'nama'])->toArray();
})->name('motor.categories');

// mobil
Route::get('daftar-mobil', [CarController::class, 'index'])->name('car.index');
Route::get('/daftar-mobil/{car}', [CarController::class, 'show'])->name('car.show');

// motor
Route::get('daftar-motor', [MotoController::class, 'index'])->name('moto.index');
Route::get('/daftar-motor/{moto}', [MotoController::class, 'show'])->name('moto.show');

Route::post('daftar-mobil', [CarController::class, 'store'])->name('car.store');
Route::get('blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('blog/{blog:slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('tentang-kami', [AboutController::class, 'index']);
Route::get('kontak', [ContactController::class, 'index']);
Route::post('kontak', [ContactController::class, 'store'])->name('contact.store');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/password-update', [ProfileController::class, 'updatePassword'])->name('password.update.custom');
    Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
    Route::post('/booking/cancel', [BookingController::class, 'cancelBooking'])->name('history.cancel');
    Route::get('/check-availability/{vehicle_type}/{vehicle_id}', [BookingController::class, 'showAvailabilityForm'])->name('check_availability');
    Route::get('/check-vehicle-availability/{vehicle_type}/{vehicle_id}', [BookingController::class, 'checkVehicleAvailability'])->name('check_vehicle_availability');
    Route::get('/booking-form/{vehicle_type}/{vehicle_id}', [BookingController::class, 'showBookingForm'])->name('booking_form');
    Route::post('/book-vehicle/{vehicle_type}/{vehicle_id}', [BookingController::class, 'bookVehicle'])->name('book_vehicle');
    Route::get('/booking-confirmation/{booking_code}/{vehicle_type}/{vehicle_id}', [BookingController::class, 'showBookingConfirmation'])->name('booking_confirmation');
    Route::get('/booking-confirmation/{booking_code}', [BookingController::class, 'showDetails'])->name('booking_detail');
    Route::get('/booking-confirmation/success/{booking_code}', [BookingController::class, 'showBookingSuccess'])->name('booking_success');
    Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
    Route::post('/profile/update-avatar', [ProfileController::class, 'updateAvatar'])->name('profile.update.avatar');  // Route untuk update avatar
});

Route::get('password/reset', 'App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'App\Http\Controllers\Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'App\Http\Controllers\Auth\ResetPasswordController@reset')->name('password.update');

Auth::routes(['verify' => true]);

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('is_admin');

Route::group(['middleware' => ['is_admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::resource('admin', AdminController::class);
    Route::post('/update-avatar', [AdminController::class, 'updateAvatar'])->name('settings.updateAvatar');
    Route::post('/password-update', [AdminController::class, 'updatePassword'])->name('password.update.custom');
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    Route::resource('cars', \App\Http\Controllers\Admin\CarController::class);
    Route::resource('motorcycles', \App\Http\Controllers\Admin\MotorcycleController::class);
    Route::get('/bookings', [AdminBookingController::class, 'index'])->name('admin.bookings.index');
    Route::match(['get', 'post'], '/motorcycles/{motorcycle}/edit_image/{image}', [\App\Http\Controllers\Admin\MotorcycleController::class, 'editImage'])->name('motorcycles.edit_image');
    Route::match(['get', 'post'], '/motorcycles/{motorcycle}/update_image/{image}', [\App\Http\Controllers\Admin\MotorcycleController::class, 'updateImage'])->name('motorcycles.update_image');
    Route::match(['get', 'post'], '/cars/{car}/edit_image/{image}', [\App\Http\Controllers\Admin\CarController::class, 'editImage'])->name('cars.edit_image');
    Route::match(['get', 'post'], '/cars/{car}/update_image/{image}', [\App\Http\Controllers\Admin\CarController::class, 'updateImage'])->name('cars.update_image');
    Route::resource('types', \App\Http\Controllers\Admin\TypeController::class);
    Route::resource('typemotorcycles', \App\Http\Controllers\Admin\TypeMotorcycleController::class);
    Route::resource('testimonials', \App\Http\Controllers\Admin\TestimonialController::class);
    Route::resource('feedbacks', \App\Http\Controllers\Admin\FeedbackController::class);
    Route::resource('teams', \App\Http\Controllers\Admin\TeamController::class);
    Route::resource('settings', SettingController::class);
    Route::post('/settings/update-logo', [SettingController::class, 'updateLogo'])->name('settings.updateLogo');
    Route::resource('faqs', \App\Http\Controllers\Admin\FAQController::class);
    Route::resource('contacts', \App\Http\Controllers\Admin\ContactController::class)->only(['index', 'destroy']);
    Route::resource('bookings', \App\Http\Controllers\Admin\BookingController::class);
    Route::resource('cancellations', \App\Http\Controllers\Admin\CancellationController::class);
    Route::resource('blogs', \App\Http\Controllers\Admin\BlogController::class);
    Route::resource('drivers', \App\Http\Controllers\Admin\DriverController::class);
    Route::get('/bookings/cetak/pdf', [AdminBookingController::class, 'generatePdf'])->name('bookings.pdf');
});
