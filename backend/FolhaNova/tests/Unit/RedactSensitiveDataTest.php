<?php

namespace Tests\Unit;

use App\Logging\RedactSensitiveData;
use PHPUnit\Framework\TestCase;

class RedactSensitiveDataTest extends TestCase
{
    public function test_it_redacts_sensitive_values_in_strings_and_context_arrays(): void
    {
        $redactor = new RedactSensitiveData;

        $message = $redactor->redactValue('Falha no CPF 529.982.247-25 com salario_base=5200.00');
        $context = $redactor->redactValue([
            'cpf' => '529.982.247-25',
            'payload' => [
                'nis' => '12345678901',
                'observacao' => 'Documento 111.444.777-35',
            ],
        ]);

        $this->assertSame('Falha no CPF ***.***.***-** com salario_base=[REDACTED]', $message);
        $this->assertSame('[REDACTED]', $context['cpf']);
        $this->assertSame('[REDACTED]', $context['payload']['nis']);
        $this->assertSame('Documento ***.***.***-**', $context['payload']['observacao']);
    }
}
