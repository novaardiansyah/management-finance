<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// * Controller
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
  return view('welcome');
});

Route::prefix('auth')->group(function () {
  Route::get('/login', [AuthController::class, 'index'])->middleware('guest')->name('login');
  Route::post('/login', [AuthController::class, 'authenticate']);
  Route::get('/register', [AuthController::class, 'create'])->middleware('guest')->name('register');
  Route::post('/register', [AuthController::class, 'store']);
  Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
});

Route::prefix('dashboard')->group(function () {
  Route::get('/', [DashboardController::class, 'index'])->middleware('auth');
});