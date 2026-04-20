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
            ->assertSee('S1040-SUP');
    }
}
