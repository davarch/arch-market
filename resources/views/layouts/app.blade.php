<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <meta name="msapplication-TileColor" content="#1E1F43">
    <meta name="theme-color" content="#1E1F43">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite('resources/js/app.js')
</head>
<body x-data="{ 'showTaskUploadModal': false, 'showTaskEditModal': false }" x-cloak>
    @include('partials.header')

    {{ $slot }}

    @include('partials.footer')
</body>
</html>
