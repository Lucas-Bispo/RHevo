<?php

namespace App\Logging;

use Illuminate\Log\Logger as IlluminateLogger;
use Monolog\Logger as MonologLogger;
use Monolog\LogRecord;

class RedactSensitiveData
{
    /**
     * @var array<string, string>
     */
    private const PATTERNS = [
        '/\b\d{3}\.\d{3}\.\d{3}-\d{2}\b/' => '***.***.***-**',
        '/\b\d{11}\b/' => '***********',
        '/\b\d{14}\b/' => '**************',
        '/("?(?:cpf|nis|salario|salario_base|password|senha|certificado|private_key|token)"?\s*[:=]\s*)(\[[^\]]*\]|"[^"]*"|\'[^\']*\'|[^\s,;}\]]+)/i' => '$1[REDACTED]',
    ];

    public function __invoke(IlluminateLogger|MonologLogger $logger): void
    {
        $monolog = $logger instanceof IlluminateLogger ? $logger->getLogger() : $logger;
        $processor = $this->processor();

        $monolog->pushProcessor($processor);

        foreach ($monolog->getHandlers() as $handler) {
            if (method_exists($handler, 'pushProcessor')) {
                $handler->pushProcessor($processor);
            }
        }
    }

    private function processor(): callable
    {
        return function (LogRecord $record): LogRecord {
            return $record->with(
                message: $this->redactValue($record->message),
                context: $this->redactValue($record->context),
                extra: $this->redactValue($record->extra),
            );
        };
    }

    /**
     * @template T
     *
     * @param  T  $value
     * @return T|string|array<mixed>
     */
    public function redactValue(mixed $value): mixed
    {
        if (is_string($value)) {
            return $this->redactString($value);
        }

        if (is_array($value)) {
            foreach ($value as $key => $item) {
                $value[$key] = $this->isSensitiveKey($key)
                    ? '[REDACTED]'
                    : $this->redactValue($item);
            }
        }

        return $value;
    }

    private function redactString(string $value): string
    {
        foreach (self::PATTERNS as $pattern => $replacement) {
            $value = preg_replace($pattern, $replacement, $value) ?? $value;
        }

        return $value;
    }

    private function isSensitiveKey(mixed $key): bool
    {
        if (! is_string($key)) {
            return false;
        }

        return preg_match('/cpf|nis|salario|salario_base|password|senha|certificado|private_key|token/i', $key) === 1;
    }
}
