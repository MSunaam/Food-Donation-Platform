<?php

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
    return view('home')->with('message', 'Please Login');
})->name('home.blade.php');

Route::controller(UserController::class)->group(function (){
    Route::get('/registerUser', 'register')->name('registerUser');
    Route::post('/registerUser', 'create')->name('createUser');
    Route::get('/logout', 'logout')->name('logout');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
})->middleware('auth');

Route::get('/dashboard', [FoodItemController::class, 'getCategoryInfo'])->name('dashboard')->middleware('auth');

Route::post('/add_item', [FoodItemController::class, 'add'])->name('add_item');


//Route::get('/test', [])
