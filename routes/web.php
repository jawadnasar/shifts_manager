<?php
use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\CertificatesController;
use App\Http\Controllers\Admin\EmailTemplateController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Admin\Users_Info_Controller;
use App\Http\Controllers\Admin\User_Privileges_Controller;
use App\Http\Controllers\ApplyController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\security_agency\Recruitment_Form_Controller;
use App\Http\Controllers\ServicesController;
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
Route::get('/services/mobile-patrolling-security-detail', [ServicesController::class, 'PersonalBodyGuardDetail'])->name('mobile-patrolling-security-detail');
Route::get('/services/shopping-malls-security-detail', [ServicesController::class, 'ShoppingMallSecurityDetail'])->name('shopping-malls-security-detail');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact/add', [ContactController::class, 'add'])->name('contact.add');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/apply', [ApplyController::class, 'index'])->name('apply');
Route::post('/apply/save', [ApplyController::class, 'save'])->name('apply.save');

Route::resource('/security_agency_recruitment_form', Recruitment_Form_Controller::class);
Route::get('/confirm', [Recruitment_Form_Controller::class, 'confirm'])->name('confirm');


// Admin routes
Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    /*Users Info*/
    Route::get('/users_info', [Users_Info_Controller::class, 'index'])->name('users_info');
    Route::get('/users_info/{id}', [Users_Info_Controller::class, 'show'])->name('admin.users_info.show');

    /*Certificates*/
    Route::get('/certificates', [CertificatesController::class, 'index'])->name('certificates');
    Route::get('/certificates/getall', [CertificatesController::class, 'getall'])->name('certificates.getall');
    Route::post('/certificates/save', [CertificatesController::class, 'save'])->name('certificates.save');
    Route::post('/certificates/edit', [CertificatesController::class, 'edit'])->name('certificates.edit');
    Route::delete('/certificates/delete/', [CertificatesController::class, 'delete'])->name('certificates.delete');

    /*Feedbacks*/
    Route::get('/feedbacks', [FeedbackController::class, 'index'])->name('feedbacks');
    Route::delete('/feedbacks/delete', [FeedbackController::class, 'delete'])->name('feedbacks.delete');

    Route::resource('/user_privileges', User_Privileges_Controller::class, ['as' => 'admin']);  

    //Email template routes
    Route::get('/templates', [EmailTemplateController::class, 'index'])->name('templates');
    Route::post('/templates/save', [EmailTemplateController::class, 'save'])->name('templates.save');
    Route::post('/templates/edit', [EmailTemplateController::class, 'edit'])->name('templates.edit');
    Route::delete('/templates/delete', [EmailTemplateController::class, 'delete'])->name('templates.delete');





});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
