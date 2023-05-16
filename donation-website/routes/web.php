<?php

use App\Http\Controllers\SchedulingController;
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

Route::get('/dashboard', function () {
    return view('users.foodBank.dashboard');
})->name('dashboard')->middleware('auth');



<<<<<<< Updated upstream
Route::post('/add_item', [FoodItemController::class, 'add'])->name('add_item');


Route::post('/add_scheduling', [SchedulingController::class, 'add'])->name('add_scheduling');



Route::get('/gotoschedule', function () {
    return view('users.dashboardschedule');
})->name('dashboardschedule');


=======
Route::post('/mark_schedule', [DonationController::class, 'markComplete'])->name('mark_schedule')->middleware('auth');


Route::post('/update_profile', [UpdateProfileController::class, 'updateProfile'])->name('update_profile')->middleware('auth');
//Route::get('/test', [])
>>>>>>> Stashed changes
