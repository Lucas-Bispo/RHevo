<?php

namespace Tests\Feature;

use App\Logging\RedactSensitiveData;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class LoggingRedactionTest extends TestCase
{
    public function test_configured_log_channel_redacts_sensitive_data(): void
    {
        $path = storage_path('logs/redaction-test.log');

        if (file_exists($path)) {
            unlink($path);
        }

        config([
            'logging.default' => 'single',
            'logging.channels.single.path' => $path,
            'logging.channels.single.tap' => [RedactSensitiveData::class],
        ]);

        Log::forgetChannel('single');

        Log::warning('Falha no CPF 529.982.247-25 com senha=abc', [
            'nis' => '12345678901',
            'salario_base' => '5200.00',
        ]);

        $contents = file_get_contents($path);

        $this->assertIsString($contents);
        $this->assertStringContainsString('***.***.***-**', $contents);
        $this->assertStringContainsString('senha=[REDACTED]', $contents);
        $this->assertStringNotContainsString('529.982.247-25', $contents);
        $this->assertStringNotContainsString('12345678901', $contents);
        $this->assertStringNotContainsString('5200.00', $contents);
    }
}
