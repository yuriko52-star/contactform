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

