<?php
use App\Http\Controllers\Admin\MainPageController;
use App\Http\Controllers\Admin\UsersPageController;
use App\Http\Controllers\Admin\StatisticsPageController;
use App\Http\Controllers\Admin\AccountPageController;
use App\Http\Controllers\Admin\SettingsPageController;
use App\Http\Controllers\Admin\InputDataFromRefController;
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

Route::get('/', [MainPageController::class, 'index'])->middleware(['auth'])->name('home');
//Route::get('/inputpoint/', [InputDataFromRefController::class, 'main'])->name('inputpoint');

Route::get('/users', [UsersPageController::class, 'main'])->middleware(['auth'])->name('users');
Route::get('/statistics', [StatisticsPageController::class, 'main'])->middleware(['auth'])->name('statistics');
Route::get('/account', [AccountPageController::class, 'main'])->middleware(['auth'])->name('account');
Route::get('/settings', [SettingsPageController::class, 'main'])->middleware(['auth'])->name('sttings');
Route::get('/debug', [GetDataController::class, 'debug'])->name('debug');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
