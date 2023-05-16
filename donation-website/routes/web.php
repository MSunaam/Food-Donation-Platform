<?php

use App\Http\Controllers\DonationController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserController;
use App\Http\Controllers\FoodItemController;

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

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::controller(UserController::class)->group(function (){
    Route::get('/registerUser', 'register')->name('registerUser');
    Route::post('/registerUser', 'create')->name('createUser');
    Route::get('/logout', 'logout')->name('logout');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/profile', 'profileView')->name('profile');
    Route::post('/updateProfile', 'updateProfile')->name('updateProfile');
})->middleware('auth');

Route::get('/dashboard', [FoodItemController::class, 'getCategoryInfo'])->name('dashboard')->middleware('auth');

Route::get('/updateInfo', [FoodItemController::class, 'getCategoryInfo'])->name('refreshData')->middleware('auth');

Route::post('/add_item', [FoodItemController::class, 'add'])->name('add_item')->middleware('auth');

Route::post('/add_donation', [DonationController::class, 'addDonation'])->name('add_donation')->middleware('auth');

Route::post('/mark_schedule', [DonationController::class, 'markComplete'])->name('mark_schedule')->middleware('auth');
//Route::get('/test', [])
