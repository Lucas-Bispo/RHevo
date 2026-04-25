<?php

namespace App\Policies\Concerns;

use App\Models\User;

trait EnforcesTenantAuthorization
{
    /**
     * Permite bypass para administracao global.
     */
    public function before(User $user, string $ability): ?bool
    {
        return $user->role === 'super_admin' ? true : null;
    }

    /**
     * SECURITY: somente usuarios autenticados dentro de um tenant podem acessar o modulo.
     */
    public function viewAny(User $user): bool
    {
        return $this->isTenantUser($user);
    }

    /**
     * SECURITY: criacao restrita ao tenant autenticado.
     */
    public function create(User $user): bool
    {
        return $this->isTenantUser($user);
    }

    protected function isTenantUser(User $user): bool
    {
        return $user->tenant_id !== null;
    }

    protected function belongsToSameTenant(User $user, object $model): bool
    {
        $modelTenantId = $model->tenant_id ?? $model->id ?? null;

        return $user->tenant_id !== null
            && $modelTenantId !== null
            && (int) $user->tenant_id === (int) $modelTenantId;
    }
}
