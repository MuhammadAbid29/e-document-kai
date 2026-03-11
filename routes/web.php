<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\DocumentController;
 use App\Http\Controllers\AuditLogController;
 use App\Http\Controllers\TrashController;
 use App\Models\Divisi;
use App\Models\User;
use App\Models\Folder;
use App\Models\Document;
use App\Models\AuditLog;

 Route::get('/sampah',[TrashController::class,'index'])->name('trash.index');

Route::post('/sampah/restore/{id}',[TrashController::class,'restore'])->name('trash.restore');

Route::delete('/sampah/delete/{id}',[TrashController::class,'forceDelete'])->name('trash.delete');


Route::get('/forgot-password',
    [ForgotPasswordController::class,'form'])
    ->name('password.request');


Route::post('/forgot-password',
    [ForgotPasswordController::class,'sendOtp'])
    ->name('password.email');


Route::get('/reset-otp/{email}',
    [ForgotPasswordController::class,'otpForm']);


Route::post('/verify-otp',
    [ForgotPasswordController::class,'verifyOtp']);


Route::get('/reset-password-form/{email}',
    [ForgotPasswordController::class,'passwordForm']);


Route::post('/reset-password',
    [ForgotPasswordController::class,'resetPassword']);

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

    $totalDivisi = Divisi::count();
    $totalAkun = User::count();
    $totalFolder = Folder::count();
    $totalDokumen = Document::count();

    $aktivitas = AuditLog::latest()->take(5)->get();
    $dokumenTerbaru = Document::latest()->take(5)->get();

    return view('dashboard', compact(
        'totalDivisi',
        'totalAkun',
        'totalFolder',
        'totalDokumen',
        'aktivitas',
        'dokumenTerbaru'
    ));
})->name('dashboard');

   /* DOKUMEN */

Route::post('/folder/store', 
    [DocumentController::class,'storeFolder'])
    ->name('folder.store');

Route::post('/folder/rename/{id}', 
    [DocumentController::class,'renameFolder'])
    ->name('folder.rename');

Route::delete('/folder/delete/{id}', 
    [DocumentController::class,'deleteFolder'])
    ->name('folder.delete');

Route::post('/dokumen/upload', 
    [DocumentController::class,'upload'])
    ->name('dokumen.upload');

Route::delete('/dokumen/delete/{id}', 
    [DocumentController::class,'deleteFile'])
    ->name('dokumen.delete');

/* TARUH PALING BAWAH */
Route::get('/dokumen/{divisi_id?}/{folder_id?}', 
    [DocumentController::class,'index'])
    ->name('dokumen.index');

    /* SUPERADMIN ONLY */
    Route::middleware('role:superadmin')->group(function () {

        Route::resource('divisi', DivisiController::class);

        Route::resource('akun', UserController::class);

    });


    /* PROFILE (semua user bisa akses) */
    Route::get('/profile', [ProfileController::class, 'show'])
        ->name('profile.show');


Route::get('/audit-log',
    [AuditLogController::class, 'index'])
    ->name('audit.index');
});


require __DIR__.'/auth.php';