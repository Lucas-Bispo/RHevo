<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/login', navigate: true);
    }
}; ?>

<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="panel-surface fixed inset-y-0 left-0 z-40 w-72 border-r border-white/10 p-4 transition-transform duration-300 lg:static lg:w-auto lg:translate-x-0">
        <div class="flex items-center gap-3 rounded-2xl border border-white/10 bg-white/5 p-3">
            <x-application-logo class="h-12 w-12" />
            <div>
                <p class="text-xs uppercase tracking-[0.35em] text-slate-400">FolhaNova</p>
                <p class="text-sm font-semibold text-white">Administração Pública</p>
            </div>
        </div>

        <div class="mt-6 space-y-1">
            <a href="{{ route('dashboard') }}" wire:navigate class="sidebar-link {{ request()->routeIs('dashboard') ? 'sidebar-link-active' : '' }}">
                <span>Dashboard</span>
            </a>
            <a href="javascript:void(0)" class="sidebar-link">
                <span>Servidores</span>
            </a>
            <a href="javascript:void(0)" class="sidebar-link">
                <span>Lotações</span>
            </a>
            <a href="javascript:void(0)" class="sidebar-link">
                <span>Cargos</span>
            </a>
            <a href="javascript:void(0)" class="sidebar-link">
                <span>Rubricas</span>
            </a>
            <a href="javascript:void(0)" class="sidebar-link">
                <span>Eventos eSocial</span>
            </a>
            <a href="{{ route('profile') }}" wire:navigate class="sidebar-link {{ request()->routeIs('profile') ? 'sidebar-link-active' : '' }}">
                <span>Perfil</span>
            </a>
        </div>

        <div class="mt-8 rounded-2xl border border-cyan-400/10 bg-cyan-400/5 p-4">
            <p class="text-xs uppercase tracking-[0.3em] text-cyan-300">Ambiente</p>
            <p class="mt-2 text-sm text-slate-200">WSL Ubuntu 24.04 com stack Laravel pronta para evolução multi-tenant.</p>
        </div>

        <div class="mt-6 border-t border-white/10 pt-4">
            <button wire:click="logout" class="btn btn-outline btn-sm w-full border-white/15 text-white hover:border-red-400 hover:bg-red-500/10">
                Sair
            </button>
        </div>
</aside>
