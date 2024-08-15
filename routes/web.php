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


route::get('exercises/{exercise}',[ExerciseController::class,'show'])->name('exercises.show');

route::get('edit',function () {
    return view('edit');
});


Route::get('/exercises/search', [ExerciseController::class, 'search'])->name('exercises.search')->middleware('exercisecount');

Route::post('exercises/softDeleteOrRestore/{id}', [ExerciseController::class, 'softDeleteOrRestore'])->name('exercises.softDeleteOrRestore')->middleware('auth');

Route::get('admin-exercises/restore/{exercise}', [AdminExerciseController::class, 'restore'])->name('admin-exercises.restore');

Route::resource('admin-exercises', AdminExerciseController::class)->middleware('auth');

Route::get('/account', [AccountController::class, 'edit'])->name('account.edit')->middleware('auth');

Route::put('/account', [AccountController::class, 'update'])->name('account.update')->middleware('auth');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Auth::routes();
