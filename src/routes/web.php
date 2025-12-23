<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;


/* Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/', [ContactController::class, 'index']);
Route::post('/confirm',[ContactController::class, 'confirm']);
Route::post('/contacts',[ContactController::class,'store']);
Route::get('/admin',[ContactController::class,'admin']);
Route::get('/search',[ContactController::class,'search']);
Route::get('/contacts/{contact}',[ContactController::class,'show'])->name('contacts.show');
Route::delete('/contacts/{contact}', [ContactController::class,'destroy']);
Route::post('/contacts/export',[ContactController::class,'export'])->name('contacts.export');
