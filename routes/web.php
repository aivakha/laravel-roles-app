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


Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    // Posts
    Route::resource('posts', \App\Http\Controllers\PostController::class);
    // Roles
    Route::resource('roles', \App\Http\Controllers\RoleController::class)->middleware(['role:super-user']);
    // Users
    Route::resource('users', \App\Http\Controllers\UserController::class)->middleware(['role:super-user']);
});










require __DIR__.'/auth.php';
