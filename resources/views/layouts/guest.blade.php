<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
        <link rel="apple-touch-icon" sizes="180x180" href="./apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="./favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="./favicon-16x16.png">
        <link rel="mask-icon" href="./safari-pinned-tab.svg" color="#1E1F43">
        <meta name="msapplication-TileColor" content="#1E1F43">
        <meta name="theme-color" content="#1E1F43">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        @vite('resources/js/app.js')
    </head>
    <body x-data="{ 'showTaskUploadModal': false, 'showTaskEditModal': false }" x-cloak>
        <main class="md:min-h-screen md:flex md:items-center md:justify-center py-16 lg:py-20">
            {{ $slot }}
        </main>
    </body>
</html>
