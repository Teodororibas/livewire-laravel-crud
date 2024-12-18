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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/table', function () {
    return view('admin.index');
});

Route::get('/filter', function () {
    return view('admin.indexfilter');
});

Route::get('/login', function () {
    return view('admin.indexlogin');
});

Route::get('/checkin', function () {
    return view('admin.indexcheckin');
});





