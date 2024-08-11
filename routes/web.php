<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminExerciseController;

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
    return view('home');
});

Route::resource('exercises',App\Http\Controllers\ExerciseController::class);


route::get('details',function () {
    return view('details');
});

route::get('edit',function () {
    return view('edit');
});


Route::resource('admin-exercises', AdminExerciseController::class)->middleware('auth');


Route::get('/account', [AccountController::class, 'edit'])->name('account.edit')->middleware('auth');

Route::put('/account', [AccountController::class, 'update'])->name('account.update')->middleware('auth');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Auth::routes();
