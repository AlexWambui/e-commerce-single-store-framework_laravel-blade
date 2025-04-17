<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <meta name="author" content="Alex Aaqil">

        <link rel="icon" href="{{ asset('assets/images/default-image.webp') }}" type="image/x-icon">

        @vite(['resources/css/icons/icons.css', 'resources/js/app.js'])

        {{ $head ?? '' }}
    </head>
    <body>
        {{ $slot }}

        {{ $scripts ?? '' }}
    </body>
</html>
