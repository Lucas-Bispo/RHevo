<?php

namespace App\Policies;

use App\Models\Lotacao;
use App\Models\User;
use App\Policies\Concerns\EnforcesTenantAuthorization;

class LotacaoPolicy
{
    use EnforcesTenantAuthorization;

    /**
     * SECURITY: atualizacao restrita ao mesmo tenant.
     */
    public function update(User $user, Lotacao $lotacao): bool
    {
        return $this->belongsToSameTenant($user, $lotacao);
    }
}
