<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'general-pages.index')->name('home-page');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboards.index')->name('dashboard');

    Route::view('/profile/edit', 'livewire.auth.edit-profile')->name('profile.edit');

    Route::get('/config/check-gd-driver-for-image-intervention', function () {
        // Check if the GD and Imagick extensions are installed
        $gd_installed = extension_loaded('gd');
        $imagick_installed = extension_loaded('imagick');

        return response()->json([
            'gd_installed' => $gd_installed,
            'imagick_installed' => $imagick_installed,
        ]);
    });
});

require __DIR__.'/auth.php';
