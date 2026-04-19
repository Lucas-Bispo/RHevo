<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="dim" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'FolhaNova') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=jetbrains-mono:400,500,700|outfit:300,400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-slate-100">
        <div x-data="{ sidebarOpen: false }" class="min-h-screen lg:grid lg:grid-cols-[300px_1fr]">
            <livewire:layout.navigation />

            <div class="lg:pl-0">
                <header class="sticky top-0 z-30 border-b border-white/10 bg-slate-950/70 backdrop-blur">
                    <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-4 sm:px-6 lg:px-8">
                        <div class="flex items-center gap-3">
                            <button @click="sidebarOpen = !sidebarOpen" class="btn btn-ghost btn-sm lg:hidden">
                                Menu
                            </button>

                            <div>
                                <p class="text-xs uppercase tracking-[0.35em] text-slate-400">Painel administrativo</p>
                                <h1 class="text-lg font-semibold text-white">
                                    @if (isset($header))
                                        {{ $header }}
                                    @else
                                        Gestão de RH e Folha
                                    @endif
                                </h1>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <button type="button" onclick="window.toggleTheme()" class="btn btn-ghost btn-sm">
                                Alternar tema
                            </button>

                            <div class="hidden rounded-2xl border border-white/10 bg-white/5 px-4 py-2 text-right sm:block">
                                <p class="text-sm font-semibold text-white">{{ auth()->user()?->name }}</p>
                                <p class="text-xs text-slate-400">{{ auth()->user()?->email }}</p>
                            </div>
                        </div>
                    </div>
                </header>

                <main class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
