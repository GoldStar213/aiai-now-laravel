<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(static function () {

    // Guest routes
    Route::middleware('guest:admin')->group(static function () {
        // Auth routes
        Route::get('login', [\App\Http\Controllers\Admin\Auth\AuthenticatedSessionController::class, 'create'])->name('admin.login');
        Route::post('login', [\App\Http\Controllers\Admin\Auth\AuthenticatedSessionController::class, 'store']);
        // Forgot password
        Route::get('forgot-password', [\App\Http\Controllers\Admin\Auth\PasswordResetLinkController::class, 'create'])->name('admin.password.request');
        Route::post('forgot-password', [\App\Http\Controllers\Admin\Auth\PasswordResetLinkController::class, 'store'])->name('admin.password.email');
        // Reset password
        Route::get('reset-password/{token}', [\App\Http\Controllers\Admin\Auth\NewPasswordController::class, 'create'])->name('admin.password.reset');
        Route::post('reset-password', [\App\Http\Controllers\Admin\Auth\NewPasswordController::class, 'store'])->name('admin.password.update');
    });

    // Verify email routes
    Route::middleware(['auth:admin'])->group(static function () {
        Route::get('verify-email', [\App\Http\Controllers\Admin\Auth\EmailVerificationPromptController::class, '__invoke'])->name('admin.verification.notice');
        Route::get('verify-email/{id}/{hash}', [\App\Http\Controllers\Admin\Auth\VerifyEmailController::class, '__invoke'])->middleware(['signed', 'throttle:6,1'])->name('admin.verification.verify');
        Route::post('email/verification-notification', [\App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1')->name('admin.verification.send');
    });

    // Authenticated routes
    Route::middleware(['auth:admin', 'verified'])->group(static function () {
        // Confirm password routes
        Route::get('confirm-password', [\App\Http\Controllers\Admin\Auth\ConfirmablePasswordController::class, 'show'])->name('admin.password.confirm');
        Route::post('confirm-password', [\App\Http\Controllers\Admin\Auth\ConfirmablePasswordController::class, 'store']);
        // Logout route
        Route::post('logout', [\App\Http\Controllers\Admin\Auth\AuthenticatedSessionController::class, 'destroy'])->name('admin.logout');
        // General routes
        Route::get('/', [\App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.index');
        Route::get('profile', [\App\Http\Controllers\Admin\HomeController::class, 'profile'])->middleware('password.confirm.admin')->name('admin.profile');

        Route::post('/services/image', [\App\Http\Controllers\Admin\ServiceController::class, 'image'])->name('admin.services.image');
        Route::post('/services/image/batch', [\App\Http\Controllers\Admin\ServiceController::class, 'image_batch'])->name('admin.services.image.batch');
        Route::get('/services/import', [\App\Http\Controllers\Admin\ServiceController::class, 'import'])->name('admin.services.import.index');
        Route::post('/services/import/excel', [\App\Http\Controllers\Admin\ServiceController::class, 'import_excel'])->name('admin.services.import.excel');
        Route::post('/services/publish', [\App\Http\Controllers\Admin\ServiceController::class, 'publish'])->name('admin.services.publish');
        Route::resource('services', \App\Http\Controllers\Admin\ServiceController::class)->names('admin.services');

        Route::post('/comments/create', [\App\Http\Controllers\Admin\CommentController::class, 'create'])->name('admin.comments.create');
        Route::post('/comments/process', [\App\Http\Controllers\Admin\CommentController::class, 'process'])->name('admin.comments.process');

        Route::post('orders/message', [\App\Http\Controllers\Admin\OrderController::class, 'message'])->name('admin.orders.message');
        Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class)->names('admin.orders');

        Route::resource('contacts', \App\Http\Controllers\Admin\ContactController::class)->names('admin.contacts');

        Route::post('categories/image/delete', [\App\Http\Controllers\Admin\CategoryController::class, 'image_delete'])->name('admin.categories.image.delete');
        Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class)->names('admin.categories');

        Route::resource('regions', \App\Http\Controllers\Admin\RegionController::class)->names('admin.regions');

        Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->names('admin.users');
    });
});

