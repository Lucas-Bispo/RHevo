<?php

namespace App\Services\EventosEsocial;

use App\Models\EventoEsocial;
use App\Services\Esocial\Payloads\S1000PayloadBuilder;
use App\Services\Esocial\Xml\EsocialXmlFactory;
use App\Services\Esocial\Xml\EsocialXsdValidator;
use InvalidArgumentException;

class GerarXmlEventoEsocialService
{
    public function __construct(
        private readonly S1000PayloadBuilder $s1000PayloadBuilder,
        private readonly EsocialXmlFactory $xmlFactory,
        private readonly EsocialXsdValidator $xsdValidator,
    ) {}

    public function execute(EventoEsocial $eventoEsocial): EventoEsocial
    {
        if ($eventoEsocial->evento !== 'S-1000') {
            throw new InvalidArgumentException('A geracao local de XML esta habilitada apenas para o S-1000 nesta etapa.');
        }

        $tenant = $eventoEsocial->tenant;

        if ($tenant === null) {
            throw new InvalidArgumentException('Evento S-1000 sem tenant associado.');
        }

        $xml = $this->xmlFactory->s1000($tenant);
        $validation = $this->xsdValidator->validateS1000($xml);

        $eventoEsocial->update([
            'payload' => $this->s1000PayloadBuilder->internalPayload($tenant),
            'xml_gerado' => $xml,
            'xml_hash' => hash('sha256', $xml),
            'xml_validacao_status' => $validation->status,
            'xml_validacao_mensagem' => $validation->message,
            'xml_gerado_em' => now(),
            'xml_validado_em' => now(),
        ]);

        return $eventoEsocial->fresh();
    }
}
