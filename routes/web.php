<?php

use App\Http\Controllers\security_agency\Recruitment_Form_Controller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/agency_recruitment_form', Recruitment_Form_Controller::class);