<?php

declare(strict_types=1);

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

require __DIR__.'/../vendor/autoload.php';

$app = require __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

if (! Schema::hasTable('tenants')) {
    Schema::create('tenants', function (Blueprint $table): void {
        $table->id();
        $table->uuid('uuid')->unique();
        $table->string('name');
        $table->string('slug')->unique();
        $table->string('domain')->unique();
        $table->string('database')->unique();
        $table->boolean('is_active')->default(true);
        $table->json('metadata')->nullable();
        $table->timestamps();
    });
}

$tenantId = null;

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
                'classificacao_tributaria' => '85',
                'natureza_juridica' => '1244',
                'inicio_validade' => '2026-04',
                'fim_validade' => null,
                'ambiente_esocial' => 'homologacao',
                'contato_nome' => 'Equipe RH Demo',
                'contato_email' => 'rh-demo@prefeitura.local',
            ],
        ],
    ]
);

$tenantId = $tenant->id;

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
