<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ActivateController;
use App\Http\Controllers\SurveyController;

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



Route::get('/activate/{token}', [ActivateController::class, 'activate'])->name('activate');
Route::put('password-activate', [ActivateController::class, 'password_activate'])->name('password-activate');

Route::get('/', function () {
    return view('dashboard'); //vérifié si emailverifiedat est rempli
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('articles', PostController::class);
    Route::post('articles/create_with_group', [PostController::class, 'create_with_group'])->name('articles.create_with_group');

    Route::resource('sondages', SurveyController::class);

    Route::resource('groups', GroupController::class);
    Route::resource('users', UserController::class);
    Route::resource('client', ClientController::class);


});


require __DIR__.'/auth.php';
