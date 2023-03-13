<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\tombolController;
use App\Http\Controllers\tombol1Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\kamar;

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

// Route::view('/','dashboard' )->name('dasboard');



// Route::view('/kwh','kwh')->name('kwh');

Route::get('/phpinfo', function(){
	return phpinfo();
});

Route::controller(KamarController::class)->group(function () {
    Route::get('/', 'dashboard')->name('home');
    Route::get('/dashboard', 'dashboard')->name('dasboard');
    Route::get('/api/kamar/{id}', 'readAPI_id');
    Route::get('/api/kamar/{id}/{aksi}', 'readAPI_id_aksi');
    Route::get('/api/kamar', 'readAPI');
    Route::post('/api/toggle/{id}/{str}', 'changeState');
    // Route::get('/create', 'create');
});
Route::post('/tombol1', [tombol1Controller::class, 'store']); 
Route::post('/tombol', [tombolController::class, 'store']); 

require __DIR__.'/auth.php';
