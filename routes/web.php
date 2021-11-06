<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Admin/Welcome');
})->middleware('auth')->name('admin.dashboard');
Route::get('language/{lang}', function ($lang) {
    session(['locale' => $lang]);
    return redirect()->back();
})->name('lang.switch')->where('lang', 'ar|en');
require __DIR__ . '/auth.php';
