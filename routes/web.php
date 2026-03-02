<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {

    if (auth()->check()) {
        return redirect('/dashboard');
    }

    return redirect('/login');

});


Route::middleware(['auth'])->group(function () {
Route::post('/profile/photo', [ProfileController::class,'uploadPhoto'])
    ->name('profile.photo');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | SUPERADMIN ONLY
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:superadmin')->group(function () {

        Route::resource('divisi', DivisiController::class);

        Route::resource('akun', UserController::class);

    });


    /*
    |--------------------------------------------------------------------------
    | PROFILE (semua user bisa akses)
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'show'])
        ->name('profile.show');

});


require __DIR__.'/auth.php';