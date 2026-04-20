<?php

declare(strict_types=1);

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

require __DIR__.'/../vendor/autoload.php';

$app = require __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$tenantId = null;

if (Schema::hasTable('tenants')) {
    $tenant = Tenant::query()->firstOrCreate(
        ['slug' => 'prefeitura-demo'],
        [
            'uuid' => (string) Str::uuid(),
            'name' => 'Prefeitura Demo',
            'domain' => 'prefeitura-demo.local',
            'database' => 'landlord',
            'is_active' => true,
            'metadata' => [
                'orgao_publico' => [
                    'tipo_inscricao' => '1',
                    'numero_inscricao' => '12.345.678/0001-99',
                    'inicio_validade' => '2026-04',
                    'ambiente_esocial' => 'homologacao',
                ],
            ],
        ]
    );

    $tenantId = $tenant->id;
}

$user = User::query()->updateOrCreate(
    ['email' => 'test@example.com'],
    [
        'tenant_id' => $tenantId,
        'name' => 'Test User',
        'password' => 'password',
    ]
);

$user->forceFill([
    'tenant_id' => $tenantId,
    'email_verified_at' => Carbon::now(),
])->save();

echo 'USER_ID='.$user->id.PHP_EOL;
echo 'EMAIL='.$user->email.PHP_EOL;
echo 'TENANT_ID='.$user->tenant_id.PHP_EOL;
echo 'EMAIL_VERIFIED_AT='.$user->email_verified_at?->toDateTimeString().PHP_EOL;
echo 'TOTAL_USERS='.User::query()->count().PHP_EOL;
