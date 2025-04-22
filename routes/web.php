<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Users\ManageUsers;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GeneralPageController;

Route::controller(GeneralPageController::class)->group(function () {
    Route::get('/', 'index')->name('home-page');

    Route::get('about', 'about')->name('about-page');

    Route::get('services', 'services')->name('services-page');

    Route::get('contact', 'contact')->name('contact-page');
    Route::post('contact', 'storeMessage')->name('messages.store');
});

Route::middleware(['authenticated_user'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::view('profile/edit', 'livewire.auth.edit-profile')->name('profile.edit'); 
});

Route::middleware(['admin_only'])->group(function() {
    Route::get('users', ManageUsers::class)->name('users.index');

    Route::get('messages', [GeneralPageController::class, 'listMessages'])->name('messages.index');
    Route::get('messages/{message}/show', [GeneralPageController::class, 'showMessage'])->name('messages.show');
    Route::delete('/messages/{message}/destroy', [GeneralPageController::class, 'destroyMessage'])->name('messages.destroy');
});

require __DIR__.'/auth.php';

require __DIR__.'/configs.php';
