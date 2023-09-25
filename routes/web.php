<?php

use App\Http\Controllers\FormViewController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/login', [LoginController::class, 'getUserByDni'])->name('loginStart');
Route::get('/formView', [FormViewController::class])->name('formView');
Route::post('/formView', [FormViewController::class, 'saveFormData'])->name('save');