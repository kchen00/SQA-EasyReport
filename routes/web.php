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

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\StudentController;

Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');
Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
    Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});

Route::get('/', function () {
    return redirect()->route('home');
});


Route::get("/student/list", [StudentController::class, "list"])
    ->middleware("auth")
    ->name("student.list");
Route::get("/student/view/{student_id}", [StudentController::class, "view"])
    ->middleware("auth")
    ->name("student.view");
Route::get("/student/add", [StudentController::class, "add"])
    ->middleware("auth")
    ->name("student.add");
Route::post("/student/store", [StudentController::class, "store"])
    ->middleware("auth")
    ->name("student.store");
Route::delete("/student/delete/{student_id}", [StudentController::class, "destroy"])
    ->middleware("auth")
    ->name("student.destroy");

// manage class routes
Route::middleware('auth')->group(function () {
    Route::get('/school_class/list', [SchoolClassController::class, 'list'])->name('school_class.list');
    Route::get('/school_class/view/{class_id}', [SchoolClassController::class, 'view'])->name('school_class.view');
    Route::get('/school_class/add', [SchoolClassController::class, 'add'])->name('school_class.add');
    Route::get('/school_class/update/{class_id}', [SchoolClassController::class, 'update'])->name('school_class.update');
    Route::post('/school_class/update/store/{class_id}', [SchoolClassController::class, 'update_store'])->name('school_class.update.store');
    Route::post('/school_class/store', [SchoolClassController::class, 'store'])->name('school_class.store');
    Route::delete('/school_class/delete/{class_id}', [SchoolClassController::class, 'destroy'])->name('school_class.destroy');
});
