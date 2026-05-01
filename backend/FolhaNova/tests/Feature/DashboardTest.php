<?php

namespace Tests\Feature;

use App\Models\Cargo;
use App\Models\EventoEsocial;
use App\Models\Funcao;
use App\Models\Lotacao;
use App\Models\Pessoa;
use App\Models\Rubrica;
use App\Models\Servidor;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_uses_current_tenant_operational_counts(): void
    {
        Carbon::setTestNow('2026-04-24 10:00:00');

        $this->ensureTenantsTableExists();

        $tenant = Tenant::query()->create([
            'uuid' => (string) Str::uuid(),
            'name' => 'Prefeitura Painel Demo',
            'slug' => 'prefeitura-painel-demo',
            'domain' => 'prefeitura-painel-demo.local',
            'database' => 'tenant_dashboard_demo',
            'is_active' => true,
            'metadata' => [
                'orgao_publico' => [
                    'tipo_inscricao' => '1',
                    'numero_inscricao' => '11.222.333/0001-81',
                    'classificacao_tributaria' => '85',
                    'natureza_juridica' => '1244',
                    'inicio_validade' => '2026-01',
                    'fim_validade' => '',
                    'ambiente_esocial' => 'homologacao',
                ],
            ],
        ]);

        $user = User::factory()->create([
            'tenant_id' => $tenant->id,
        ]);

        Servidor::query()->create([
            'tenant_id' => $tenant->id,
            'pessoa_id' => $this->createPessoaId($tenant->id, 'Servidor Ativo Demo', '529.982.247-25'),
            'matricula' => 'DASH-001',
            'tipo_vinculo' => 'estatutario',
            'data_admissao' => '2026-01-10',
            'salario_base' => 4500,
            'situacao' => 'ativo',
        ]);

        Servidor::query()->create([
            'tenant_id' => 92,
            'pessoa_id' => $this->createPessoaId(92, 'Servidor Outro Tenant', '111.444.777-35'),
            'matricula' => 'DASH-OUTRO',
            'tipo_vinculo' => 'estatutario',
            'data_admissao' => '2026-01-10',
            'salario_base' => 4500,
            'situacao' => 'ativo',
        ]);

        Lotacao::query()->create([
            'tenant_id' => $tenant->id,
            'codigo' => 'DASH-LOT-OK',
            'nome' => 'Lotacao pronta dashboard',
            'tipo' => 'secretaria',
            'codigo_esocial' => 'S1020-OK',
            'ativa' => true,
        ]);

        Lotacao::query()->create([
            'tenant_id' => $tenant->id,
            'codigo' => 'DASH-LOT-PEND',
            'nome' => 'Lotacao pendente dashboard',
            'tipo' => 'setor',
            'codigo_esocial' => null,
            'ativa' => true,
        ]);

        Lotacao::query()->create([
            'tenant_id' => 92,
            'codigo' => 'DASH-LOT-OUTRO',
            'nome' => 'Lotacao outro tenant',
            'tipo' => 'secretaria',
            'codigo_esocial' => 'S1020-OUTRO',
            'ativa' => true,
        ]);

        Cargo::query()->create([
            'tenant_id' => $tenant->id,
            'codigo' => 'DASH-CAR-OK',
            'nome' => 'Cargo pronto dashboard',
            'codigo_esocial' => 'S1030-OK',
            'ativo' => true,
        ]);

        Cargo::query()->create([
            'tenant_id' => $tenant->id,
            'codigo' => 'DASH-CAR-PEND',
            'nome' => 'Cargo pendente dashboard',
            'codigo_esocial' => null,
            'ativo' => true,
        ]);

        Cargo::query()->create([
            'tenant_id' => 92,
            'codigo' => 'DASH-CAR-OUTRO',
            'nome' => 'Cargo outro tenant',
            'codigo_esocial' => 'S1030-OUTRO',
            'ativo' => true,
        ]);

        $servidorPronto = Servidor::query()->create([
            'tenant_id' => $tenant->id,
            'pessoa_id' => $this->createPessoaId($tenant->id, 'Servidor S2200 Pronto', '390.533.447-05', '1990-02-10'),
            'lotacao_id' => Lotacao::query()->where('tenant_id', $tenant->id)->where('codigo', 'DASH-LOT-OK')->value('id'),
            'cargo_id' => Cargo::query()->where('tenant_id', $tenant->id)->where('codigo', 'DASH-CAR-OK')->value('id'),
            'matricula' => 'DASH-S2200-OK',
            'tipo_vinculo' => 'estatutario',
            'categoria_esocial' => '301',
            'regime_previdenciario' => 'rp',
            'data_admissao' => '2026-02-01',
            'salario_base' => 4800,
            'situacao' => 'ativo',
        ]);

        EventoEsocial::query()->create([
            'tenant_id' => $tenant->id,
            'servidor_id' => $servidorPronto->id,
            'evento' => 'S-2200',
            'status' => 'pendente',
            'ambiente' => 'homologacao',
            'payload' => ['origem' => 'dashboard_s2200_test'],
        ]);

        Funcao::query()->create([
            'tenant_id' => $tenant->id,
            'codigo' => 'DASH-FUN-OK',
            'nome' => 'Funcao pronta dashboard',
            'codigo_esocial' => 'S1040-OK',
            'ativo' => true,
        ]);

        Funcao::query()->create([
            'tenant_id' => $tenant->id,
            'codigo' => 'DASH-FUN-PEND',
            'nome' => 'Funcao pendente dashboard',
            'codigo_esocial' => null,
            'ativo' => true,
        ]);

        Funcao::query()->create([
            'tenant_id' => 92,
            'codigo' => 'DASH-FUN-OUTRO',
            'nome' => 'Funcao outro tenant',
            'codigo_esocial' => 'S1040-OUTRO',
            'ativo' => true,
        ]);

        Rubrica::query()->create([
            'tenant_id' => $tenant->id,
            'codigo' => 'DASH-RUB',
            'nome' => 'Rubrica dashboard',
            'natureza' => '1000',
            'tipo' => 'provento',
            'incide_irrf' => true,
            'incide_inss' => true,
            'incide_fgts' => true,
            'codigo_esocial' => null,
            'inicio_validade' => '2026-01-01',
            'ativo' => true,
        ]);

        Rubrica::query()->create([
            'tenant_id' => $tenant->id,
            'codigo' => 'DASH-RUB-OK',
            'nome' => 'Rubrica pronta dashboard',
            'natureza' => '1000',
            'tipo' => 'provento',
            'incide_irrf' => true,
            'incide_inss' => true,
            'incide_fgts' => false,
            'codigo_esocial' => 'S1010-OK',
            'inicio_validade' => '2026-01-01',
            'fim_validade' => null,
            'ativo' => true,
        ]);

        Rubrica::query()->create([
            'tenant_id' => $tenant->id,
            'codigo' => 'DASH-RUB-FUT',
            'nome' => 'Rubrica futura dashboard',
            'natureza' => '1002',
            'tipo' => 'provento',
            'incide_irrf' => true,
            'incide_inss' => false,
            'incide_fgts' => false,
            'codigo_esocial' => 'S1010-FUT',
            'inicio_validade' => '2026-06-01',
            'fim_validade' => '2026-12-31',
            'ativo' => false,
        ]);

        Rubrica::query()->create([
            'tenant_id' => $tenant->id,
            'codigo' => 'DASH-RUB-ENC',
            'nome' => 'Rubrica encerrada dashboard',
            'natureza' => '9201',
            'tipo' => 'desconto',
            'incide_irrf' => false,
            'incide_inss' => false,
            'incide_fgts' => false,
            'codigo_esocial' => 'S1010-ENC',
            'inicio_validade' => '2025-01-01',
            'fim_validade' => '2026-03-31',
            'ativo' => false,
        ]);

        EventoEsocial::query()->create([
            'tenant_id' => $tenant->id,
            'servidor_id' => null,
            'evento' => 'S-1000',
            'status' => 'pendente',
            'ambiente' => 'homologacao',
            'payload' => ['origem' => 'dashboard_orgao_test'],
        ]);

        EventoEsocial::query()->create([
            'tenant_id' => $tenant->id,
            'evento' => 'S-1010',
            'status' => 'erro',
            'ambiente' => 'homologacao',
            'mensagem_retorno' => 'Retorno dashboard.',
            'payload' => ['origem' => 'dashboard_test'],
        ]);

        $this
            ->actingAs($user)
            ->get(route('dashboard'))
            ->assertOk()
            ->assertSee('Dashboard Operacional')
            ->assertSee('Atalhos para testar a massa demo')
            ->assertSee('Servidores ativos')
            ->assertSee('Eventos com erro')
            ->assertSee('Rubricas sem codigo')
            ->assertSee('Prontos S-2200')
            ->assertSee('Pendencias S-2200')
            ->assertSee('Prontas S-1010')
            ->assertSee('Pendencias S-1010')
            ->assertSee('Prontas S-1005/S-1020')
            ->assertSee('Pendencias S-1005/S-1020')
            ->assertSee('Prontos S-1030')
            ->assertSee('Pendencias S-1030')
            ->assertSee('Prontas S-1040')
            ->assertSee('Pendencias S-1040')
            ->assertSee('Vigencia ativa')
            ->assertSee('Vigencia futura')
            ->assertSee('Vigencia encerrada')
            ->assertSee('Triagem S-1000')
            ->assertSee('Prefeitura Painel Demo')
            ->assertSee('Evento S-1000')
            ->assertSee('Prontidao')
            ->assertSee('Base S-1000 pronta')
            ->assertSee('Parametros institucionais e evento local estao consistentes.')
            ->assertSee('Pendencias')
            ->assertSee('Abrir orgao publico')
            ->assertSee('Abrir S-1000')
            ->assertSee('Triagem S-2200')
            ->assertSee('Prontidao das admissoes')
            ->assertSee('Servidores prontos S-2200')
            ->assertSee('Triagem S-1005/S-1020')
            ->assertSee('Prontidao das lotacoes')
            ->assertSee('Lotacoes prontas')
            ->assertSee('Pendencias estruturais')
            ->assertSee('Triagem S-1030/S-1040')
            ->assertSee('Prontidao ocupacional')
            ->assertSee('Cargos prontos S-1030')
            ->assertSee('Funcoes prontas S-1040')
            ->assertSee('Triagem S-1010')
            ->assertSee('Prontidao das rubricas')
            ->assertSee('Rubricas prontas S-1010')
            ->assertSee('Triagem eSocial')
            ->assertSee('Fila operacional')
            ->assertSee('href="'.route('rubricas.index', ['esocial' => 'sem_codigo']).'"', false)
            ->assertSee('href="'.route('servidores.index', ['prontidao' => 'pronto']).'"', false)
            ->assertSee('href="'.route('servidores.index', ['prontidao' => 'pendente']).'"', false)
            ->assertSee('href="'.route('eventos-esocial.index', ['evento' => 'S-2200']).'"', false)
            ->assertSee('href="'.route('rubricas.index', ['prontidao' => 'pronta']).'"', false)
            ->assertSee('href="'.route('rubricas.index', ['prontidao' => 'pendente']).'"', false)
            ->assertSee('href="'.route('lotacoes.index', ['prontidao' => 'pronta']).'"', false)
            ->assertSee('href="'.route('lotacoes.index', ['prontidao' => 'pendente']).'"', false)
            ->assertSee('href="'.route('lotacoes.index', ['status' => 'ativas']).'"', false)
            ->assertSee('href="'.route('cargos.index', ['prontidao' => 'pronto']).'"', false)
            ->assertSee('href="'.route('cargos.index', ['prontidao' => 'pendente']).'"', false)
            ->assertSee('href="'.route('funcoes.index', ['prontidao' => 'pronta']).'"', false)
            ->assertSee('href="'.route('funcoes.index', ['prontidao' => 'pendente']).'"', false)
            ->assertSee('href="'.route('rubricas.index', ['vigencia' => 'ativa']).'"', false)
            ->assertSee('href="'.route('rubricas.index', ['vigencia' => 'futura']).'"', false)
            ->assertSee('href="'.route('rubricas.index', ['vigencia' => 'encerrada']).'"', false)
            ->assertSee('href="'.route('orgao-publico.show').'"', false)
            ->assertSee('href="'.route('eventos-esocial.index', ['evento' => 'S-1000']).'"', false)
            ->assertSee('href="'.route('eventos-esocial.index', ['status' => 'erro']).'"', false)
            ->assertSee('href="'.route('eventos-esocial.index', ['status' => 'pendente']).'"', false)
            ->assertSee('href="'.route('eventos-esocial.index', ['retorno' => 'com_mensagem']).'"', false);

        Carbon::setTestNow();
    }

    public function test_dashboard_keeps_s1000_with_error_as_pending_readiness(): void
    {
        $this->ensureTenantsTableExists();

        $tenant = Tenant::query()->create([
            'uuid' => (string) Str::uuid(),
            'name' => 'Prefeitura S1000 Erro',
            'slug' => 'prefeitura-s1000-erro',
            'domain' => 'prefeitura-s1000-erro.local',
            'database' => 'tenant_s1000_erro',
            'is_active' => true,
            'metadata' => [
                'orgao_publico' => [
                    'tipo_inscricao' => '1',
                    'numero_inscricao' => '11.222.333/0001-81',
                    'classificacao_tributaria' => '85',
                    'natureza_juridica' => '1244',
                    'inicio_validade' => '2026-01',
                    'fim_validade' => '',
                    'ambiente_esocial' => 'homologacao',
                ],
            ],
        ]);

        EventoEsocial::query()->create([
            'tenant_id' => $tenant->id,
            'servidor_id' => null,
            'evento' => 'S-1000',
            'status' => 'erro',
            'ambiente' => 'homologacao',
            'mensagem_retorno' => 'Falha de validacao institucional.',
            'payload' => ['origem' => 'dashboard_orgao_test'],
        ]);

        $user = User::factory()->create([
            'tenant_id' => $tenant->id,
        ]);

        $this
            ->actingAs($user)
            ->get(route('dashboard'))
            ->assertOk()
            ->assertSee('Base S-1000 com pendencias')
            ->assertSee('Revise o orgao publico antes da integracao futura.')
            ->assertSee('>1<', false)
            ->assertDontSee('Base S-1000 pronta');
    }

    private function ensureTenantsTableExists(): void
    {
        if (Schema::hasTable('tenants')) {
            return;
        }

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

    private function createPessoaId(int $tenantId, string $nome, string $cpf, ?string $dataNascimento = null): int
    {
        return Pessoa::query()->create([
            'tenant_id' => $tenantId,
            'nome_completo' => $nome,
            'cpf' => $cpf,
            'data_nascimento' => $dataNascimento,
        ])->id;
    }
}
