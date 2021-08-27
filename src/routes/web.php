<?php

use App\Http\Controllers\Admin\AdminController;
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
});

// TODO add routing 

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth:users')->group(function () {
    // TODO add routing 
});

/**
 * 管理用ルーティング
 */
Route::get('/admin/login', [AdminController::class, 'index'])->name('admin.auth.login.index');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.auth.login');