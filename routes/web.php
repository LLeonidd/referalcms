<?php
use App\Http\Controllers\Admin\MainPageController;
use App\Http\Controllers\Admin\UsersPageController;
use App\Http\Controllers\Admin\StatisticsPageController;
use App\Http\Controllers\Admin\AccountPageController;
use App\Http\Controllers\Admin\SettingsPageController;
use App\Http\Controllers\Admin\InputDataFromRefController;
use App\Http\Controllers\Admin\Inputs\PhoneController;
use App\Http\Controllers\Admin\Inputs\EmailController;
use App\Http\Controllers\Admin\Inputs\AddressController;
use App\Http\Controllers\Admin\Inputs\SettingController;
use App\Http\Controllers\Admin\Inputs\SiteController;
use App\Http\Controllers\Admin\Inputs\UserController;
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
Route::get('/inputpoint/', [InputDataFromRefController::class, 'main'])->name('inputpoint');

Route::get('/users', [UsersPageController::class, 'main'])->middleware(['auth'])->name('users');
//Route::get('/statistics', [StatisticsPageController::class, 'main'])->middleware(['auth'])->name('statistics');
Route::get('/statistics', [MainPageController::class, 'index'])->middleware(['auth'])->name('statistics');
Route::get('/account', [AccountPageController::class, 'main'])->middleware(['auth'])->name('account');
Route::get('/settings', [SettingsPageController::class, 'main'])->middleware(['auth'])->name('settings');
Route::get('/debug', [GetDataController::class, 'debug'])->name('debug');

Route::post('/phone-add', [PhoneController::class, 'store'])->middleware(['auth'])->name('phone');
Route::post('/email-add', [EmailController::class, 'store'])->middleware(['auth'])->name('email');
Route::post('/address-add', [AddressController::class, 'store'])->middleware(['auth'])->name('address');
Route::post('/setting-add', [SettingController::class, 'store'])->middleware(['auth'])->name('setting');
Route::post('/site-add', [SiteController::class, 'store'])->middleware(['auth'])->name('site');
Route::post('/user-add', [UserController::class, 'store'])->middleware(['auth'])->name('user');

Route::post('/phone-edit', [PhoneController::class, 'update'])->middleware(['auth'])->name('phone');
Route::post('/email-edit', [EmailController::class, 'update'])->middleware(['auth'])->name('email');
Route::post('/address-edit', [AddressController::class, 'update'])->middleware(['auth'])->name('address');
Route::post('/setting-edit', [SettingController::class, 'update'])->middleware(['auth'])->name('setting');
Route::post('/site-edit', [SiteController::class, 'update'])->middleware(['auth'])->name('site');
Route::post('/user-edit', [UserController::class, 'update'])->middleware(['auth'])->name('user');


Route::post('/phone-delete', [PhoneController::class, 'delete'])->middleware(['auth'])->name('phone');
Route::post('/email-delete', [EmailController::class, 'delete'])->middleware(['auth'])->name('email');
Route::post('/address-delete', [AddressController::class, 'delete'])->middleware(['auth'])->name('address');
Route::post('/setting-delete', [SettingController::class, 'delete'])->middleware(['auth'])->name('setting');
Route::post('/site-delete', [SiteController::class, 'delete'])->middleware(['auth'])->name('site');
Route::post('/user-delete', [UserController::class, 'delete'])->middleware(['auth'])->name('user');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
