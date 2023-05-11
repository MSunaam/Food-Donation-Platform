<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserController;

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

Route::get('/loginUser', function (){
    return view('login');
})->name('loginUser');

Route::controller(UserController::class)->group(function (){
    Route::get('/registerUser', 'register')->name('registerUser');
});

//Route::get('/registerUser', UserController::)->name('registerUser');
