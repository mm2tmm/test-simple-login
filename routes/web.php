<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use Illuminate\Http\Request;


Route::view('/', 'home')->name('home');
Route::get('/account', [AccountController::class, 'login']);

Route::get('/getpassword' , [AccountController::class, 'getpasswordform']);
Route::post('/getpassword' , [AccountController::class, 'getpassword']);

Route::post('/checkpassword' , [AccountController::class,'checkpassword']);

Route::get('smsverify', [AccountController::class, 'sendOtp']);
Route::post('smsverify', [AccountController::class,'smsverify']);

Route::get('resetpassword', [AccountController::class,'sendOtp']);
Route::post('resetpassword', [AccountController::class,'resetpassword']);

Route::get('logout', [AccountController::class,'logout']);
Route::get('no-messsage', function(Request $request){
    $request->session()->forget(['success', 'error', 'warning', 'info']);
    return redirect()->route('home');
});
