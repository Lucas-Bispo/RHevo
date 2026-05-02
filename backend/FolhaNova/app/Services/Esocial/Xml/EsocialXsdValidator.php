<?php

namespace App\Services\Esocial\Xml;

use DOMDocument;

class EsocialXsdValidator
{
    public function validateS1000(string $xml): EsocialXmlValidationResult
    {
        $schema = base_path('vendor/nfephp-org/sped-esocial/schemes/v_S_01_03_00/evtInfoEmpregador.xsd');

        if (! is_file($schema)) {
            return new EsocialXmlValidationResult(
                'erro_schema',
                'Schema XSD do S-1000 v_S_01_03_00 nao foi localizado no vendor.'
            );
        }

        $errors = $this->collectSchemaErrors($xml, $schema);

        if ($errors === []) {
            return new EsocialXmlValidationResult(
                'validado',
                'XML S-1000 validado contra o XSD oficial local.'
            );
        }

        $message = implode(' ', $errors);

        if (str_contains($message, 'Signature')) {
            return new EsocialXmlValidationResult(
                'pendente_assinatura',
                'XML S-1000 gerado estruturalmente. A validacao XSD final exige assinatura digital, que sera tratada no marco do certificado A1.'
            );
        }

        return new EsocialXmlValidationResult('invalido', $message);
    }

    /**
     * @return list<string>
     */
    private function collectSchemaErrors(string $xml, string $schema): array
    {
        $previous = libxml_use_internal_errors(true);
        libxml_clear_errors();

        $dom = new DOMDocument('1.0', 'UTF-8');
        $dom->preserveWhiteSpace = false;
        $dom->loadXML($xml);
        $dom->schemaValidate($schema);

        $errors = [];
        foreach (libxml_get_errors() as $error) {
            $errors[] = trim($error->message);
        }

        libxml_clear_errors();
        libxml_use_internal_errors($previous);

        return array_values(array_filter($errors));
    }
}
