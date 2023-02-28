<?php

use App\Http\Controllers\Admin\DashboardController as DashboardController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\TypeController as TypeController;
use App\Http\Controllers\Guest\ProjectController as GuestProjectController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::get('/index', [GuestProjectController::class, 'index'])->name('guests.index');

//Qui posso inserire tutte le rotte solo per gli utenti che sono autenticati e verificati
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/projects', AdminProjectController::class);
    Route::get('/trash', [AdminProjectController::class, 'trash'])->name('trash');
    Route::post('/{project}/restore', [AdminProjectController::class, 'restore'])->name('restore');
    Route::delete('/{project}/force-delete', [AdminProjectController::class, 'forceDelete'])->name('force-delete');
    Route::post('/restore-all', [AdminProjectController::class, 'restoreAll'])->name('restore-all');
    Route::resource('/types', TypeController::class);
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
