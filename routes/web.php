<?php

use App\Http\Controllers\DHT11Controller;
use App\Http\Controllers\LedController;
use App\Http\Controllers\WebiotController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [LedController::class, 'index']);
Route::get('/Dht11', [DHT11Controller::class, 'index']);
Route::get('/Dht11/getdata', [DHT11Controller::class, 'getData']);
Route::get('/Dht11/uploaddata/{temperature}/{humidity}', [DHT11Controller::class, 'uploadData']);
Route::get('/', [WebiotController::class, 'index']);
Route::get('/rfid/update/{tag}', [WebiotController::class, 'update']);
Route::get('/rfid/update/{tag}/{nama}/{status}', [WebiotController::class, 'updateTag']);
Route::get('/rfid/checkUser', [WebiotController::class, 'checkUser']);
Route::get('/rfid/tambah/{tag}/{nama}/{status}', [WebiotController::class, 'tambahTag']);
Route::get('/rfid/checkRfid', [WebiotController::class, 'checkRfid']);
Route::get('/rfid/checkTable', [WebiotController::class, 'checkTable']);
