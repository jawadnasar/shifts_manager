<?php
use App\Http\Controllers\security_agency\Recruitment_Form_Controller;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ApplyController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\Users_Info_Controller;
use Illuminate\Support\Facades\Route;

// Redirect root URL to /home
Route::get('/', function () {
    return redirect()->route('home');
});

// Home route pointing to HomeController's index method
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/services', [ServicesController::class, 'index'])->name('services');
Route::get('/services/reception-security-detail', [ServicesController::class, 'receptionDetail'])->name('reception-security-detail');
Route::get('/services/site-security-detail', [ServicesController::class, 'SiteScurityDetail'])->name('site-security-detail');
Route::get('/services/door-security-detail', [ServicesController::class, 'DoorSecurityDetail'])->name('door-security-detail');
Route::get('/services/events-security-detail', [ServicesController::class, 'EventSecurityDetail'])->name('events-security-detail');
Route::get('/services/personal-body-guard-security-detail', [ServicesController::class, 'PersonalBodyGuardDetail'])->name('personal-body-guard-security-detail');
Route::get('/services/shopping-malls-security-detail', [ServicesController::class, 'ShoppingMallSecurityDetail'])->name('shopping-malls-security-detail');


Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/apply', [ApplyController::class, 'index'])->name('apply');



Route::resource('/agency_recruitment_form', Recruitment_Form_Controller::class);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/** We also need admin middleware for this page */
Route::get('/admin/users_info', [Users_Info_Controller::class, 'index'])->name('users_info');

require __DIR__.'/auth.php';