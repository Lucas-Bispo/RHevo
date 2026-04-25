<?php

namespace App\Policies;

use App\Models\Rubrica;
use App\Models\User;
use App\Policies\Concerns\EnforcesTenantAuthorization;

class RubricaPolicy
{
    use EnforcesTenantAuthorization;

    /**
     * SECURITY: atualizacao restrita ao mesmo tenant.
     */
    public function update(User $user, Rubrica $rubrica): bool
    {
        return $this->belongsToSameTenant($user, $rubrica);
    }
}
