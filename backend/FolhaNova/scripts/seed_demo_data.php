<?php

declare(strict_types=1);

use App\Models\Cargo;
use App\Models\EventoEsocial;
use App\Models\Funcao;
use App\Models\Lotacao;
use App\Models\Pessoa;
use App\Models\Rubrica;
use App\Models\Servidor;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

require __DIR__.'/../vendor/autoload.php';

$app = require __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

if (! Schema::hasTable('tenants')) {
    fwrite(STDERR, "Tabela tenants nao encontrada.\n");
    exit(1);
}

$tenant = Tenant::query()->updateOrCreate(
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
                'contato_email' => 'rh@demo.local',
                'telefone' => '1133334444',
            ],
        ],
    ]
);

$user = User::query()->updateOrCreate(
    ['email' => 'test@example.com'],
    [
        'tenant_id' => $tenant->id,
        'name' => 'Test User',
        'password' => 'password',
    ]
);

$user->forceFill([
    'tenant_id' => $tenant->id,
    'email_verified_at' => Carbon::now(),
])->save();

$lotacao = Lotacao::query()->updateOrCreate(
    ['tenant_id' => $tenant->id, 'codigo' => 'EDU-001'],
    [
        'nome' => 'Secretaria de Educacao',
        'tipo' => 'secretaria',
        'codigo_esocial' => 'S1005-EDU',
        'ativa' => true,
    ]
);

$cargo = Cargo::query()->updateOrCreate(
    ['tenant_id' => $tenant->id, 'codigo' => 'PROF-001'],
    [
        'nome' => 'Professor Municipal',
        'descricao' => 'Cargo efetivo do magisterio municipal',
        'codigo_esocial' => 'S1030-PROF',
        'ativo' => true,
    ]
);

$funcao = Funcao::query()->updateOrCreate(
    ['tenant_id' => $tenant->id, 'codigo' => 'COORD-01'],
    [
        'nome' => 'Coordenador Pedagogico',
        'descricao' => 'Funcao de coordenacao academica',
        'codigo_esocial' => 'S1040-COORD',
        'ativo' => true,
    ]
);

$rubrica = Rubrica::query()->updateOrCreate(
    ['tenant_id' => $tenant->id, 'codigo' => 'RUB-001'],
    [
        'nome' => 'Gratificacao de Funcao',
        'natureza' => 'Vencimento',
        'tipo' => 'provento',
        'incide_irrf' => true,
        'incide_inss' => true,
        'incide_fgts' => false,
        'codigo_esocial' => 'S1010-GRAT',
        'ativo' => true,
    ]
);

$pessoa = Pessoa::query()->updateOrCreate(
    ['tenant_id' => $tenant->id, 'cpf' => '123.456.789-01'],
    [
        'nome_completo' => 'Marina Souza',
        'data_nascimento' => '1992-08-21',
        'email' => 'marina.souza@prefeitura.gov.br',
        'telefone' => '11999990000',
        'cidade' => 'Sao Paulo',
        'uf' => 'SP',
    ]
);

$servidor = Servidor::query()->updateOrCreate(
    ['tenant_id' => $tenant->id, 'matricula' => 'ADM-0001'],
    [
        'pessoa_id' => $pessoa->id,
        'lotacao_id' => $lotacao->id,
        'cargo_id' => $cargo->id,
        'funcao_id' => $funcao->id,
        'tipo_vinculo' => 'estatutario',
        'categoria_esocial' => '301',
        'regime_previdenciario' => 'rpps',
        'data_admissao' => '2026-04-20',
        'salario_base' => 5875.42,
        'situacao' => 'ativo',
    ]
);

EventoEsocial::query()->updateOrCreate(
    ['tenant_id' => $tenant->id, 'evento' => 'S-1000', 'servidor_id' => null],
    [
        'status' => 'pendente',
        'ambiente' => 'homologacao',
        'payload' => [
            'evento' => 'S-1000',
            'origem' => 'seed_demo',
        ],
    ]
);

EventoEsocial::query()->updateOrCreate(
    ['tenant_id' => $tenant->id, 'evento' => 'S-2200', 'servidor_id' => $servidor->id],
    [
        'status' => 'pendente',
        'ambiente' => 'homologacao',
        'payload' => [
            'evento' => 'S-2200',
            'origem' => 'seed_demo',
        ],
    ]
);

echo 'TENANT_ID='.$tenant->id.PHP_EOL;
echo 'USER_ID='.$user->id.PHP_EOL;
echo 'USER_TENANT_ID='.$user->tenant_id.PHP_EOL;
echo 'LOTACAO_ID='.$lotacao->id.PHP_EOL;
echo 'CARGO_ID='.$cargo->id.PHP_EOL;
echo 'FUNCAO_ID='.$funcao->id.PHP_EOL;
echo 'RUBRICA_ID='.$rubrica->id.PHP_EOL;
echo 'SERVIDOR_ID='.$servidor->id.PHP_EOL;
echo 'EVENTOS='.EventoEsocial::query()->where('tenant_id', $tenant->id)->count().PHP_EOL;
