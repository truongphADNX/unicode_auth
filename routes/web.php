<?php

use App\Http\Controllers\Doctors\Auth\LoginController;
use App\Http\Controllers\Doctors\IndexController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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
    return redirect('login');
});

Auth::routes();

// Route::get('/home', function(){
//     return  redirect()->route('admin');
// })->name('home');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin', function(){
    return view('admin');
})->name('admin')->middleware(['auth','verified']);


//email verification
Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');


Route::prefix('doctors')->name('doctors.')->group(function(){
    Route::get('/', [IndexController::class, 'index'])->middleware('auth:doctor');
    Route::get('login', [LoginController::class, 'login'])->middleware('guest:doctor')->name('login');
    Route::post('login', [LoginController::class, 'postLogin'])->middleware('guest:doctor');
    Route::post('logout', function(){
        Auth::guard('doctor')->logout();
        return redirect()->route('doctors.login');
    })->middleware('auth:doctor')->name('logout');
});
