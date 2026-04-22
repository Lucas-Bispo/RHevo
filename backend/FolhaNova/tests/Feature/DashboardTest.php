<?php

namespace Tests\Feature;

use App\Models\EventoEsocial;
use App\Models\Rubrica;
use App\Models\Servidor;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_uses_current_tenant_operational_counts(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 91,
        ]);

        Servidor::query()->create([
            'tenant_id' => 91,
            'pessoa_id' => $this->createPessoaId(91, 'Servidor Ativo Demo', '529.982.247-25'),
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

        Rubrica::query()->create([
            'tenant_id' => 91,
            'codigo' => 'DASH-RUB',
            'nome' => 'Rubrica dashboard',
            'natureza' => '1000',
            'tipo' => 'provento',
            'incide_irrf' => true,
            'incide_inss' => true,
            'incide_fgts' => true,
            'codigo_esocial' => null,
            'ativo' => true,
        ]);

        EventoEsocial::query()->create([
            'tenant_id' => 91,
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
            ->assertSee('href="'.route('rubricas.index', ['esocial' => 'sem_codigo']).'"', false)
            ->assertSee('href="'.route('eventos-esocial.index', ['retorno' => 'com_mensagem']).'"', false);
    }

    private function createPessoaId(int $tenantId, string $nome, string $cpf): int
    {
        return \App\Models\Pessoa::query()->create([
            'tenant_id' => $tenantId,
            'nome_completo' => $nome,
            'cpf' => $cpf,
        ])->id;
    }
}
