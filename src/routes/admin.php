<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\ImageController;
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



Route::middleware('auth:admins')->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/user/edit/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/category/{id}', [CategoryController::class, 'detail'])->name('category.detail');
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/admin/create', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
    Route::post('/admin/edit/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::post('/admin/delete/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
    Route::post('/admin/user/csvdownload', [UserController::class, 'csvdownload'])->name('admin.user.csvdownload');
    Route::get('/admin/lesson/', [LessonController::class, 'index'])->name('admin.lesson.index');
    Route::get('/admin/lesson/create', [LessonController::class, 'create'])->name('admin.lesson.create');
    Route::post('/admin/lesson/store', [LessonController::class, 'store'])->name('admin.lesson.store');
    Route::get('/admin/lesson/edit/{id}', [LessonController::class, 'edit'])->name('admin.lesson.edit');
    Route::post('/admin/lesson/edit/{id}', [LessonController::class, 'update'])->name('admin.lesson.update');
    Route::get('/admin/lesson/detail/{id}', [LessonController::class, 'detail'])->name('admin.lesson.detail');
    Route::post('/admin/lesson/delete/{id}', [LessonController::class, 'destroy'])->name('admin.lesson.destroy');
    Route::get('/admin/lesson/img/edit/{id}', [ImageController::class, 'edit'])->name('admin.lesson.img.edit');
    Route::post('/admin/lesson/img/upload/{id}', [ImageController::class, 'update'])->name('admin.lesson.img.update');
    Route::post('/admin/lesson/{id}/section/create', [SectionController::class, 'create'])->name('admin.lesson.section.create');
    Route::post('/admin/lesson/{id}/section/update/{sec_id}', [SectionController::class, 'update'])->name('admin.lesson.section.update');
    Route::post('/admin/lesson/{id}/section/sort', [SectionController::class, 'sort'])->name('admin.lesson.section.sort');
    Route::post('/admin/lesson/{id}/section/destroy/{sec_id}', [SectionController::class, 'destroy'])->name('admin.lesson.section.destory');
});


Route::get('/register', [RegisteredUserController::class, 'create'])
                ->middleware('guest')
                ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
                ->middleware('guest');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
                ->middleware('guest')
                ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
                ->middleware('guest');

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
                ->middleware('guest')
                ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->middleware('guest')
                ->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->middleware('guest')
                ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
                ->middleware('guest')
                ->name('password.update');

Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->middleware('auth')
                ->name('verification.notice');

Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['auth', 'signed', 'throttle:6,1'])
                ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware(['auth', 'throttle:6,1'])
                ->name('verification.send');

Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->middleware('auth')
                ->name('password.confirm');

Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
                ->middleware('auth');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth')
                ->name('logout');

