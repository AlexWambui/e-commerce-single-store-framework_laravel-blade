<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/configs/check-gd-driver-for-image-intervention', function () {
        // Check if the GD and Imagick extensions are installed
        $gd_installed = extension_loaded('gd');
        $imagick_installed = extension_loaded('imagick');

        return response()->json([
            'gd_installed' => $gd_installed,
            'imagick_installed' => $imagick_installed,
        ]);
    });
});
