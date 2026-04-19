# Integração eSocial

## Objetivo

Preparar a aplicação para integração completa com o eSocial S-1.3 usando `nfephp-org/sped-esocial`.

## Premissas

- uso de certificado A1;
- assinatura digital fora do fluxo HTTP síncrono;
- filas para envio e reprocessamento;
- rastreabilidade do ciclo completo do evento;
- separação entre geração, assinatura, transmissão e leitura de retorno.

## Eventos prioritários

- S-2200
- S-2205
- S-2299
- S-1202
- S-1207
- S-1210

## Estratégia técnica inicial

- concentrar código de integração em um módulo próprio;
- persistir metadados operacionais em `eventos_esocial`;
- evitar acoplamento direto entre telas e serviços de transmissão;
- registrar protocolos, recibos, tentativas e rejeições.
