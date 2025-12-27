<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

Route::get('/debug-auth', function () {
    return auth()->check()
        ? 'ログイン中: ' . auth()->user()->email
        : '未ログイン';
});
Route::get('/', [ContactController::class, 'index']);
Route::post('/confirm',[ContactController::class, 'confirm']);
Route::post('/contacts',[ContactController::class,'store']);


Route::middleware('auth')->group(function () {
    Route::get('/admin',[ContactController::class,'admin']);
    Route::get('/search',[ContactController::class,'search']);
    Route::get('/contacts/{contact}',[ContactController::class,'show'])->name('contacts.show');
    Route::delete('/contacts/{contact}', [ContactController::class,'destroy']);
    Route::post('/contacts/export',[ContactController::class,'export'])->name('contacts.export');
});