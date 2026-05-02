<?php

namespace App\Services\Esocial\Xml;

use App\Models\Tenant;
use App\Services\Esocial\Payloads\S1000PayloadBuilder;
use NFePHP\eSocial\Event;

class EsocialXmlFactory
{
    public function __construct(
        private readonly S1000PayloadBuilder $s1000PayloadBuilder,
    ) {}

    public function s1000(Tenant $tenant): string
    {
        return Event::S1000(
            $this->s1000PayloadBuilder->config($tenant),
            $this->s1000PayloadBuilder->std($tenant)
        )->toXML();
    }
}
