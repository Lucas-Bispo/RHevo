<?php

namespace App\Policies;

use App\Models\Servidor;
use App\Models\User;

class ServidorPolicy
{
    /**
     * Permite bypass para administracao global.
     */
    public function before(User $user, string $ability): ?bool
    {
        return $user->role === 'super_admin' ? true : null;
    }

    /**
     * SECURITY: acesso de listagem apenas para usuarios autenticados do tenant.
     */
    public function viewAny(User $user): bool
    {
        return $user->tenant_id !== null;
    }

    /**
     * SECURITY: acesso permitido somente dentro do mesmo tenant.
     */
    public function view(User $user, Servidor $servidor): bool
    {
        return $this->belongsToSameTenant($user, $servidor);
    }

    /**
     * SECURITY: criação de vínculos funcionais restrita ao tenant do usuário.
     */
    public function create(User $user): bool
    {
        return $user->tenant_id !== null;
    }

    /**
     * SECURITY: atualização de servidor restrita ao mesmo tenant.
     */
    public function update(User $user, Servidor $servidor): bool
    {
        return $this->belongsToSameTenant($user, $servidor);
    }

    private function belongsToSameTenant(User $user, Servidor $servidor): bool
    {
        return $user->tenant_id !== null
            && $servidor->tenant_id !== null
            && (int) $user->tenant_id === (int) $servidor->tenant_id;
    }
}
