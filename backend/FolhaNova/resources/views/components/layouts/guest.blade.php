<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="dim" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'FolhaNova') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=jetbrains-mono:400,500,700|outfit:300,400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-slate-100">
        <div class="min-h-screen flex flex-col items-center justify-center px-4 py-8">
            <div>
                <a href="/" wire:navigate>
                    <x-application-logo class="h-16 w-16 text-cyan-300" />
                </a>
            </div>

            <div class="panel-surface mt-6 w-full overflow-hidden rounded-3xl px-6 py-6 sm:max-w-md">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
