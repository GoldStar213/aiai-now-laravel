<?php

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

Route::get('/', [\App\Http\Controllers\SiteController::class, 'index'])
    ->name('index');

Route::get('/services/list', [\App\Http\Controllers\Front\ServiceController::class, 'index'])->name('front.services.index');
Route::get('/services/show/{id}', [\App\Http\Controllers\Front\ServiceController::class, 'show'])->name('front.services.show');

Route::get('/about', [\App\Http\Controllers\Front\AboutController::class, 'index'])->name('front.about.index');

Route::get('/contact', [\App\Http\Controllers\Front\ContactController::class, 'index'])->name('front.contact.index');
Route::post('/contact/submit', [\App\Http\Controllers\Front\ContactController::class, 'submit'])->name('front.contact.submit');
Route::get('/contact/thanks', [\App\Http\Controllers\Front\ContactController::class, 'thanks'])->name('front.contact.thanks');

require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {
    // Route::get('dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');

    Route::get('/mypage/dashboard', [\App\Http\Controllers\User\HomeController::class, 'index'])->name('dashboard');

    Route::get('profile', [\App\Http\Controllers\SiteController::class, 'profile'])
        ->middleware('password.confirm')
        ->name('profile');

    Route::post('order', [\App\Http\Controllers\Front\OrderController::class, 'order'])->name('front.order');
    Route::get('order/complete/{order}', [\App\Http\Controllers\Front\OrderController::class, 'complete'])->name('front.order.complete');

    Route::post('mypage/orders/message', [\App\Http\Controllers\User\OrderController::class, 'message'])->name('user.orders.message');
    Route::resource('mypage/orders', \App\Http\Controllers\User\OrderController::class)->names('user.orders');

    Route::get('mypage/likes', [\App\Http\Controllers\User\LikeController::class, 'likes'])->name('user.likes');
});
