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

Route::get('/blade', static function () {
    return view('home');
})->name('home');

Route::get('/', static function () {
    return view('vue');
})->name('vue');

//Route::get('{any}', static function () {
//    return view('vue');
//})->where('any', '.*');

require __DIR__.'/auth.php';
