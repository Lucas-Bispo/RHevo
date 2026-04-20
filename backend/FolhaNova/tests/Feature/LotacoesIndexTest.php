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
            ->assertSee('S1005-EDU');
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
}
