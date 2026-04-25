<?php

namespace App\Policies;

use App\Models\EventoEsocial;
use App\Models\User;
use App\Policies\Concerns\EnforcesTenantAuthorization;

class EventoEsocialPolicy
{
    use EnforcesTenantAuthorization;

    /**
     * SECURITY: visualizacao restrita ao mesmo tenant.
     */
    public function view(User $user, EventoEsocial $eventoEsocial): bool
    {
        return $this->belongsToSameTenant($user, $eventoEsocial);
    }

    /**
     * SECURITY: reprocessamento restrito ao mesmo tenant.
     */
    public function update(User $user, EventoEsocial $eventoEsocial): bool
    {
        return $this->belongsToSameTenant($user, $eventoEsocial);
    }
}
