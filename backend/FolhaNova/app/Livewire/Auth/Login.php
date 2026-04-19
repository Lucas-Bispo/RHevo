<?php

namespace App\Livewire\Auth;

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.auth-login')]
class Login extends Component
{
    public LoginForm $form;

    public bool $isLoading = false;

    public bool $showAlert = false;

    public string $alertMessage = '';

    public string $prefeitura = 'Prefeitura Parceira';

    public string $contactEmail = 'suporte@folhanova.local';

    /**
     * SECURITY: autenticação centralizada no formulário existente, com rate limiting
     * e proteção CSRF padrão do Laravel/Livewire.
     *
     * BUG-PREVENTION: captura apenas exceções de validação esperadas para manter
     * feedback previsível na interface e deixar o restante subir corretamente.
     *
     * @throws ValidationException
     */
    public function login(): void
    {
        $this->isLoading = true;
        $this->showAlert = false;
        $this->alertMessage = '';

        try {
            $this->validate();

            $this->form->authenticate();
        } catch (ValidationException $exception) {
            $this->isLoading = false;
            $this->showAlert = true;
            $this->alertMessage = 'Credenciais inválidas. Revise os dados e tente novamente.';

            throw $exception;
        }

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
