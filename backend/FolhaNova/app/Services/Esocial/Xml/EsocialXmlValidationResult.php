<?php

namespace App\Services\Esocial\Xml;

readonly class EsocialXmlValidationResult
{
    public function __construct(
        public string $status,
        public string $message,
    ) {}
}
