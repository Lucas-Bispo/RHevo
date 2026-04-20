<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

class RootRedirectController extends Controller
{
    /**
     * Direciona a raiz para a primeira tela útil conforme o estado de autenticação.
     */
    public function __invoke(): RedirectResponse
    {
        return auth()->check()
            ? redirect()->route('dashboard')
            : redirect()->route('login');
    }
}
