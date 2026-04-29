<?php

namespace Tests\Feature;

use App\Models\Funcao;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FuncoesIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_open_funcoes_index(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 53,
        ]);

        Funcao::create([
            'tenant_id' => 53,
            'codigo' => 'SUP-01',
            'nome' => 'Supervisor de Unidade',
            'codigo_esocial' => 'S1040-SUP',
            'ativo' => true,
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('funcoes.index'));

        $response
            ->assertOk()
            ->assertSee('Funcoes')
            ->assertSee('Supervisor de Unidade')
            ->assertSee('S1040-SUP')
            ->assertSee('Prontas S-1040')
            ->assertSee('Pendencias S-1040')
            ->assertSee('Base para S-1040');
    }

    public function test_funcoes_index_filters_by_esocial_readiness(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 54,
        ]);

        Funcao::create([
            'tenant_id' => 54,
            'codigo' => 'COORD',
            'nome' => 'Coordenador Parametrizado',
            'codigo_esocial' => 'S1040-COORD',
            'ativo' => true,
        ]);

        Funcao::create([
            'tenant_id' => 54,
            'codigo' => 'DIR',
            'nome' => 'Diretor sem Parametrizacao',
            'codigo_esocial' => null,
            'ativo' => true,
        ]);

        Funcao::create([
            'tenant_id' => 54,
            'codigo' => 'ANT',
            'nome' => 'Funcao Antiga',
            'codigo_esocial' => 'S1040-ANT',
            'ativo' => false,
        ]);

        $readyResponse = $this
            ->actingAs($user)
            ->get(route('funcoes.index', ['prontidao' => 'pronta']));

        $readyResponse
            ->assertOk()
            ->assertSee('Coordenador Parametrizado')
            ->assertDontSee('Diretor sem Parametrizacao')
            ->assertDontSee('Funcao Antiga')
            ->assertSee('Prontidao S-1040: Pronta');

        $pendingResponse = $this
            ->actingAs($user)
            ->get(route('funcoes.index', ['prontidao' => 'pendente']));

        $pendingResponse
            ->assertOk()
            ->assertSee('Diretor sem Parametrizacao')
            ->assertSee('Funcao Antiga')
            ->assertDontSee('Coordenador Parametrizado')
            ->assertSee('Prontidao S-1040: Com pendencias');
    }
}
