<?php

use App\Http\Controllers\FormViewController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/login', [LoginController::class, 'getUserByDni'])->name('login');
Route::get('/formView', [FormViewController::class, 'renderFormView'])->name('formView');