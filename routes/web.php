<?php

use App\Livewire\UserManager;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function() {
   Route::get('/dashboard', function () {
      return view('dashboard');
   })->name('dashboard');

   Route::get('/users', UserManager::class)->name('users.index');

});
