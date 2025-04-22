<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Users\ManageUsers;
use App\Http\Controllers\DashboardController;

Route::view('/', 'general-pages.index')->name('home-page');

Route::middleware(['authenticated_user'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::view('profile/edit', 'livewire.auth.edit-profile')->name('profile.edit'); 
});

Route::middleware(['admin_only'])->group(function() {
    Route::get('users', ManageUsers::class)->name('users.index');
});

require __DIR__.'/auth.php';

require __DIR__.'/configs.php';
