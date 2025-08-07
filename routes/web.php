<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Livewire\Index::class)->name('index')->middleware('auth');
Route::get('/profile', \App\Livewire\Profile::class)->name('profile')->middleware('auth');
Route::get('/users', \App\Livewire\UserTable::class)->name('user-table')->middleware('auth');
Route::get('/login', \App\Livewire\Login::class)->name('login');
Route::get('/logout', App\Http\Controllers\LogoutController::class)->name('logout');
