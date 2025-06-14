<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\DataManagementController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\Setup\BonusController;
use App\Http\Controllers\Setup\DeductionController;
use App\Http\Controllers\Setup\DiscountController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\Setup\PayrollController;
use App\Http\Controllers\Setup\WeeklyWorkScheduleController;
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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware('auth', 'verified')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route::get('/data-management', function () {
    //     return view('dashboard');
    // })->middleware(['auth', 'verified'])->name('data-management');

    Route::get('/data-management', [DataManagementController::class, 'data_management'])->name('data-management');

    Route::get('/comportamiento', function () {
        return view('comportamiento');
    })->name('comportamiento');

    Route::resource('institutions', InstitutionController::class);
    Route::resource('areas', AreaController::class);
    Route::resource('rols', RolController::class);
    Route::resource('workers', WorkerController::class);
    Route::resource('positions', PositionController::class);

    // Sección: Setup Routes
    Route::prefix('setup')->name('setup.')->group(function () {
        // Discounts
        Route::resource('discounts', DiscountController::class);

        // Deductions
        Route::resource('deductions', DeductionController::class);

        // Bonuses
        Route::resource('bonuses', BonusController::class);

        // Payrolls
        Route::resource('payrolls', PayrollController::class);

        // Weekly Schedules
        Route::resource('weekly-schedules', WeeklyWorkScheduleController::class);
    });
});

require __DIR__ . '/auth.php';

require __DIR__ . '/livewire.php';