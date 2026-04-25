<?php

namespace App\Policies;

use App\Models\Funcao;
use App\Models\User;
use App\Policies\Concerns\EnforcesTenantAuthorization;

class FuncaoPolicy
{
    use EnforcesTenantAuthorization;

    /**
     * SECURITY: atualizacao restrita ao mesmo tenant.
     */
    public function update(User $user, Funcao $funcao): bool
    {
        return $this->belongsToSameTenant($user, $funcao);
    }
}
