<?php

namespace App\Policies;

use App\Models\Tenant;
use App\Models\User;
use App\Policies\Concerns\EnforcesTenantAuthorization;

class TenantPolicy
{
    use EnforcesTenantAuthorization;

    /**
     * SECURITY: visualizacao dos parametros do orgao publico restrita ao tenant autenticado.
     */
    public function view(User $user, Tenant $tenant): bool
    {
        return $this->belongsToSameTenant($user, $tenant);
    }

    /**
     * SECURITY: atualizacao dos parametros do orgao publico restrita ao tenant autenticado.
     */
    public function update(User $user, Tenant $tenant): bool
    {
        return $this->belongsToSameTenant($user, $tenant);
    }
}
