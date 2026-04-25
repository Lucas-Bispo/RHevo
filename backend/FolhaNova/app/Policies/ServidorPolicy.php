<?php

namespace App\Policies;

use App\Models\Servidor;
use App\Models\User;
use App\Policies\Concerns\EnforcesTenantAuthorization;

class ServidorPolicy
{
    use EnforcesTenantAuthorization;

    /**
     * SECURITY: acesso permitido somente dentro do mesmo tenant.
     */
    public function view(User $user, Servidor $servidor): bool
    {
        return $this->belongsToSameTenant($user, $servidor);
    }

    /**
     * SECURITY: atualizacao de servidor restrita ao mesmo tenant.
     */
    public function update(User $user, Servidor $servidor): bool
    {
        return $this->belongsToSameTenant($user, $servidor);
    }
}
