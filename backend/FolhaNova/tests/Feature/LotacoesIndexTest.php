<?php

namespace Tests\Feature;

use App\Models\Lotacao;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LotacoesIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_open_lotacoes_index(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 25,
        ]);

        Lotacao::create([
            'tenant_id' => 25,
            'codigo' => 'EDU',
            'nome' => 'Secretaria de Educacao',
            'tipo' => 'secretaria',
            'codigo_esocial' => 'S1005-EDU',
            'ativa' => true,
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('lotacoes.index'));

        $response
            ->assertOk()
            ->assertSee('Lotacoes')
            ->assertSee('Secretaria de Educacao')
            ->assertSee('S1005-EDU')
            ->assertSee('Prontas S-1005/S-1020')
            ->assertSee('Pendencias S-1005/S-1020')
            ->assertSee('Base para S-1005/S-1020');
    }

    public function test_index_filters_results_by_search_and_status(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 26,
        ]);

        Lotacao::create([
            'tenant_id' => 26,
            'codigo' => 'SAU',
            'nome' => 'Secretaria de Saude',
            'tipo' => 'secretaria',
            'ativa' => true,
        ]);

        Lotacao::create([
            'tenant_id' => 26,
            'codigo' => 'ARQ',
            'nome' => 'Arquivo Central',
            'tipo' => 'setor',
            'ativa' => false,
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('lotacoes.index', ['q' => 'SAU', 'status' => 'ativas']));

        $response
            ->assertOk()
            ->assertSee('Secretaria de Saude')
            ->assertDontSee('Arquivo Central');
    }

    public function test_lotacoes_index_filters_by_esocial_readiness(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 27,
        ]);

        Lotacao::create([
            'tenant_id' => 27,
            'codigo' => 'FIN',
            'nome' => 'Secretaria de Financas',
            'tipo' => 'secretaria',
            'codigo_esocial' => 'S1020-FIN',
            'ativa' => true,
        ]);

        Lotacao::create([
            'tenant_id' => 27,
            'codigo' => 'OBR',
            'nome' => 'Obras sem Parametrizacao',
            'tipo' => 'departamento',
            'codigo_esocial' => null,
            'ativa' => true,
        ]);

        Lotacao::create([
            'tenant_id' => 27,
            'codigo' => 'HIS',
            'nome' => 'Unidade Historica',
            'tipo' => 'unidade',
            'codigo_esocial' => 'S1020-HIS',
            'ativa' => false,
        ]);

        $readyResponse = $this
            ->actingAs($user)
            ->get(route('lotacoes.index', ['prontidao' => 'pronta']));

        $readyResponse
            ->assertOk()
            ->assertSee('Secretaria de Financas')
            ->assertDontSee('Obras sem Parametrizacao')
            ->assertDontSee('Unidade Historica')
            ->assertSee('Prontidao S-1005/S-1020: Pronta');

        $pendingResponse = $this
            ->actingAs($user)
            ->get(route('lotacoes.index', ['prontidao' => 'pendente']));

        $pendingResponse
            ->assertOk()
            ->assertSee('Obras sem Parametrizacao')
            ->assertSee('Unidade Historica')
            ->assertDontSee('Secretaria de Financas')
            ->assertSee('Prontidao S-1005/S-1020: Com pendencias');
    }
}
