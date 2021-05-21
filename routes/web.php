<?php

use App\Http\Controllers\Api\RecordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\PersonController;

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
Route::get('/', [DashController::class, 'index'])->name('index');

Route::group(['middleware' => 'auth'], function () {
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

    include 'device.php';

    // tmp
    Route::get('/api/{device}/all', [RecordController::class, 'index'])->name('api.records');
});

Route::group(['middleware' => 'guest'], function () {
    Route::view('login', 'auth.login')->name('login');
    Route::view('signup', 'auth.register')->name('signup');

    Route::post('/login', [LoginController::class, 'submit'])->name('login.submit');
    Route::post('/signup', [RegisterController::class, 'store'])->name('login.submit');
});

Route::get('debug', function () {
    return resolve('DeviceService')->getNameByRfid('asd');
});
