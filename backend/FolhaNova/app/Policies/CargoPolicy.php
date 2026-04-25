<?php

namespace App\Policies;

use App\Models\Cargo;
use App\Models\User;
use App\Policies\Concerns\EnforcesTenantAuthorization;

class CargoPolicy
{
    use EnforcesTenantAuthorization;

    /**
     * SECURITY: atualizacao restrita ao mesmo tenant.
     */
    public function update(User $user, Cargo $cargo): bool
    {
        return $this->belongsToSameTenant($user, $cargo);
    }
}
