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


Route::resource('exercises',App\Http\Controllers\ExerciseController::class);


route::get('exercises/{exercise}',[ExerciseController::class,'show'])->name('exercises.show');

route::get('edit',function () {
    return view('edit');
});


Route::get('/exercises/', [ExerciseController::class, 'search'])->name('exercises.search');


Route::post('exercises/switch/{id}', [ExerciseController::class, 'switch'])->name('exercises.switch')->middleware('auth')->middleware('exercisecount');

Route::get('admin-exercises/restore/{exercise}', [AdminExerciseController::class, 'restore'])->name('admin-exercises.restore');

Route::resource('admin-exercises', AdminExerciseController::class)->middleware('auth');

Route::get('/account', [AccountController::class, 'edit'])->name('account.edit')->middleware('auth');

Route::put('/account', [AccountController::class, 'update'])->name('account.update')->middleware('auth');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/not-enough', [ExerciseController::class, 'notEnough'])->name('not-enough');

Auth::routes();
