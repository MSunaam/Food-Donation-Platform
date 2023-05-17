<?php

use App\Http\Controllers\DonationController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserController;
use App\Http\Controllers\FoodItemController;
use \App\Http\Controllers\RequestController;

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
    Route::post('/delete_account', 'deleteAccount')->name('delete_account');
})->middleware('auth');

Route::controller(FoodItemController::class)->group(function (){
    Route::get('/dashboard', 'getCategoryInfo')->name('dashboard');
    Route::get('/updateInfo', 'getCategoryInfo')->name('refreshData');
    Route::post('/add_item', 'add')->name('add_item');
})->middleware('auth');

Route::controller(DonationController::class)->group(function (){
    Route::post('/add_donation','addDonation')->name('add_donation');
    Route::post('/mark_schedule','markComplete')->name('mark_schedule');
})->middleware('auth');

Route::controller(RequestController::class)->group(function (){
    Route::get('request', 'requestView')->name('request');
    Route::post('addRequest', 'addRequest')->name('addRequest');
    Route::get('getRequest', 'getRequests')->name('getRequests');
    Route::post('updateRequest', 'updateRequest')->name('updateRequest');
})->middleware('auth');
