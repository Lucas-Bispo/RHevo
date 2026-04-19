<div x-data="{ logoSpin: 0 }" class="login-shell">
    <div class="login-grid">
        <section class="login-hero" aria-hidden="true">
            <div class="login-ambient-orb ambient-orb-a"></div>
            <div class="login-ambient-orb ambient-orb-b"></div>
            <div class="login-ambient-orb ambient-orb-c"></div>

            <div class="floating-icon floating-icon-building">
                <div class="floating-icon-badge">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.65" class="h-7 w-7">
                        <path d="M4 20h16"/>
                        <path d="M6 20V9.4A2.4 2.4 0 0 1 7.2 7.3l4.8-2.8 4.8 2.8A2.4 2.4 0 0 1 18 9.4V20"/>
                        <path d="M9 11h.01M12 11h.01M15 11h.01M9 15h.01M12 15h.01M15 15h.01"/>
                    </svg>
                </div>
            </div>

            <div class="floating-icon floating-icon-network">
                <div class="floating-icon-badge">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.65" class="h-7 w-7">
                        <circle cx="6" cy="12" r="2.2"/>
                        <circle cx="18" cy="7" r="2.2"/>
                        <circle cx="18" cy="17" r="2.2"/>
                        <path d="M8 11 15.8 7.9M8 13l7.8 3.1"/>
                    </svg>
                </div>
            </div>

            <div class="floating-icon floating-icon-lock">
                <div class="floating-icon-badge">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.65" class="h-7 w-7">
                        <path d="M12 3 4 7v5c0 5 3.4 8.8 8 9.9 4.6-1.1 8-4.9 8-9.9V7l-8-4Z"/>
                        <path d="M9.5 12.5 11 14l3.5-4"/>
                    </svg>
                </div>
            </div>

            <div class="floating-icon floating-icon-logo">
                <div class="floating-icon-badge floating-icon-logo-badge">
                    <span>FN</span>
                </div>
            </div>

            <div class="floating-icon floating-icon-user">
                <div class="floating-icon-badge">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.65" class="h-7 w-7">
                        <path d="M12 12a4 4 0 1 0-4-4 4 4 0 0 0 4 4Z"/>
                        <path d="M5.5 20a6.5 6.5 0 0 1 13 0"/>
                        <path d="M15 13.5h4v5h-4z"/>
                    </svg>
                </div>
            </div>

            <div class="login-hero-copy">
                <div class="login-kicker">
                    <span class="status-dot"></span>
                    Acesso institucional
                </div>

                <h1 class="login-title">
                    Um login claro,
                    <span>seguro e profissional</span>
                    para a operação pública.
                </h1>

                <p class="login-subtitle">
                    O FolhaNova organiza o acesso ao RH e à folha com foco em estabilidade visual, colaboração institucional e confiança operacional.
                </p>

                <div class="login-hero-notes">
                    <div class="hero-note-pill">
                        <span class="hero-note-dot"></span>
                        Formulário fixo e legível
                    </div>
                    <div class="hero-note-pill">
                        <span class="hero-note-dot"></span>
                        Fundo com ícones 3D sutis
                    </div>
                </div>
            </div>
        </section>

        <section class="login-panel">
            <div class="login-theme-switch">
                <button type="button" onclick="window.toggleTheme()" class="theme-toggle-button">
                    Alternar tema
                </button>
            </div>

            <div class="login-card-wrap">
                <div class="login-card">
                    <div class="login-card-glow"></div>

                    <div class="login-brand-row">
                        <div class="brand-mark" :style="`transform: rotateY(${logoSpin}deg)`" @mouseenter="logoSpin = 10" @mouseleave="logoSpin = 0">
                            <div class="brand-mark-front">FN</div>
                            <div class="brand-mark-shadow"></div>
                        </div>

                        <div>
                            <p class="brand-label">FolhaNova Access</p>
                            <h2 class="brand-title">Entrar no sistema</h2>
                            <p class="brand-subtitle">Use seu e-mail institucional para acessar o painel de gestão. Outros identificadores podem ser incorporados na próxima etapa do fluxo.</p>
                        </div>
                    </div>

                    @if ($showAlert)
                        <div class="login-alert" x-transition.opacity.scale.95>
                            <div class="mini-3d-icon icon-orb icon-orb-indigo">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5">
                                    <path d="M12 9v4"/>
                                    <path d="M12 17h.01"/>
                                    <path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0Z"/>
                                </svg>
                            </div>

                            <div>
                                <strong>Falha de autenticação</strong>
                                <p>{{ $alertMessage }}</p>
                            </div>
                        </div>
                    @endif

                    <form wire:submit="login" class="login-form">
                        <div class="login-field">
                            <label for="email">Usuário</label>
                            <div class="input-shell">
                                <span class="input-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" class="h-5 w-5">
                                        <path d="M12 12a4 4 0 1 0-4-4 4 4 0 0 0 4 4Z"/>
                                        <path d="M5.5 20a6.5 6.5 0 0 1 13 0"/>
                                    </svg>
                                </span>

                                <input
                                    wire:model.defer="form.email"
                                    id="email"
                                    type="text"
                                    name="email"
                                    autocomplete="username"
                                    required
                                    autofocus
                                    placeholder="E-mail, matrícula ou CPF"
                                >
                            </div>

                            @error('form.email')
                                <p class="field-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="login-field">
                            <div class="field-headline">
                                <label for="password">Senha</label>
                                <a href="{{ route('password.request') }}" wire:navigate class="field-link">Esqueci minha senha</a>
                            </div>

                            <div class="input-shell">
                                <span class="input-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" class="h-5 w-5">
                                        <rect x="5" y="10" width="14" height="10" rx="2"/>
                                        <path d="M8 10V8a4 4 0 1 1 8 0v2"/>
                                    </svg>
                                </span>

                                <input
                                    wire:model.defer="form.password"
                                    id="password"
                                    type="password"
                                    name="password"
                                    autocomplete="current-password"
                                    required
                                    placeholder="Digite sua senha"
                                >
                            </div>

                            @error('form.password')
                                <p class="field-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="login-meta-row">
                            <label class="remember-toggle">
                                <input wire:model.defer="form.remember" id="remember" type="checkbox" name="remember">
                                <span class="remember-indicator"></span>
                                <span>Lembrar-me</span>
                            </label>

                            <a href="mailto:{{ $contactEmail }}" class="field-link">Contato com o administrador</a>
                        </div>

                        <div class="login-action-stack">
                            <button
                                type="submit"
                                class="login-submit-button"
                                @disabled($isLoading)
                                aria-busy="{{ $isLoading ? 'true' : 'false' }}"
                                wire:loading.attr="disabled"
                                wire:loading.class="login-submit-button-loading"
                                wire:target="login"
                            >
                                <span class="button-face button-face-primary" wire:loading.remove wire:target="login">Entrar</span>
                                <span class="button-face button-face-primary hidden" wire:loading.flex wire:target="login">
                                    <svg class="h-5 w-5 animate-spin" viewBox="0 0 24 24" fill="none">
                                        <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="3" class="opacity-25"></circle>
                                        <path d="M21 12a9 9 0 0 0-9-9" stroke="currentColor" stroke-width="3" stroke-linecap="round"></path>
                                    </svg>
                                    Entrando...
                                </span>
                            </button>
                        </div>
                    </form>

                    <div class="login-footer-strip">
                        <p class="login-license">© 2026 FolhaNova – Sistema de Folha de Pagamento | Licenciado para {{ $prefeitura }}</p>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
