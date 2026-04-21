<?php

namespace App\Services\EventosEsocial;

use App\Models\EventoEsocial;

class ReprocessarEventoEsocialService
{
    public function execute(EventoEsocial $eventoEsocial): EventoEsocial
    {
        $eventoEsocial->update([
            'status' => 'pendente',
            'protocolo' => null,
            'recibo' => null,
            'mensagem_retorno' => null,
            'enviado_em' => null,
            'processado_em' => null,
        ]);

        return $eventoEsocial->fresh();
    }
}
