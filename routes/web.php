<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\DataManagementController;
use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\WorkerController;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

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
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/data-management', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('data-management');

    Route::get('/data-management', [DataManagementController::class, 'data_management'])->name('data-management');


    Route::resource('institutions', InstitutionController::class);
    Route::resource('areas', AreaController::class);
    Route::resource('rols', RolController::class);
    Route::resource('workers', WorkerController::class);
    Route::resource('positions', PositionController::class);
});

require __DIR__ . '/auth.php';

Livewire::setScriptRoute(function ($handle) {
    return Route::get(env('APP_URL_PRE', 'null') . '/livewire/livewire.js', $handle);
});
Livewire::setUpdateRoute(function ($handle) {
    return Route::post(env('APP_URL_PRE', 'null') . '/livewire/update', $handle);
});

// Livewire::setScriptRoute(function ($handle) {
//     return Route::get(env('APP_URL_PRE', 'null') . '/livewire/livewire.js', $handle);
// });
// Livewire::setUpdateRoute(function ($handle) {
//     return Route::post(env('APP_URL_PRE', 'null') . '/livewire/update', $handle);
// });


// Livewire::setScriptRoute(function ($handle) {
//     return Route::get(env('APP_URL_PRE','null').'/livewire/livewire.js', $handle);
// });
// Livewire::setUpdateRoute(function ($handle) {
//     return Route::post(env('APP_URL_PRE','null').'/livewire/update', $handle);
// });