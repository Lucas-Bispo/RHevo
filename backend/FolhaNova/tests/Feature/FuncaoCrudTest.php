<?php

namespace Tests\Feature;

use App\Models\Funcao;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FuncaoCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_open_funcao_creation_screen(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 50,
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('funcoes.create'));

        $response
            ->assertOk()
            ->assertSee('Cadastro de funcao');
    }

    public function test_user_can_create_funcao(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 51,
        ]);

        $response = $this
            ->actingAs($user)
            ->post(route('funcoes.store'), [
                'codigo' => 'COORD-01',
                'nome' => 'Coordenador Pedagogico',
                'descricao' => 'Funcao de coordenacao academica',
                'codigo_esocial' => 'S1040-COORD',
                'ativo' => '1',
            ]);

        $response
            ->assertRedirect(route('funcoes.index'))
            ->assertSessionHas('status');

        $this->assertDatabaseHas('funcoes', [
            'tenant_id' => 51,
            'codigo' => 'COORD-01',
            'nome' => 'Coordenador Pedagogico',
            'codigo_esocial' => 'S1040-COORD',
            'ativo' => true,
        ]);
    }

    public function test_user_can_update_funcao(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 52,
        ]);

        $funcao = Funcao::create([
            'tenant_id' => 52,
            'codigo' => 'CHEF-01',
            'nome' => 'Chefia Imediata',
            'ativo' => true,
        ]);

        $response = $this
            ->actingAs($user)
            ->put(route('funcoes.update', $funcao), [
                'codigo' => 'CHEF-01',
                'nome' => 'Chefia Administrativa',
                'descricao' => 'Funcao de lideranca administrativa',
                'codigo_esocial' => 'S1040-CHEF',
                'ativo' => '0',
            ]);

        $response
            ->assertRedirect(route('funcoes.index'))
            ->assertSessionHas('status');

        $this->assertDatabaseHas('funcoes', [
            'id' => $funcao->id,
            'nome' => 'Chefia Administrativa',
            'codigo_esocial' => 'S1040-CHEF',
            'ativo' => false,
        ]);
    }

    public function test_user_cannot_update_funcao_from_another_tenant(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 52,
        ]);

        $funcao = Funcao::create([
            'tenant_id' => 99,
            'codigo' => 'OUT-FUN',
            'nome' => 'Funcao Bloqueada',
            'ativo' => true,
        ]);

        $response = $this
            ->actingAs($user)
            ->put(route('funcoes.update', $funcao), [
                'codigo' => 'OUT-FUN',
                'nome' => 'Tentativa Invalida',
                'descricao' => 'Nao deveria atualizar',
                'codigo_esocial' => 'S1040-OUT',
                'ativo' => '0',
            ]);

        $response->assertForbidden();

        $this->assertDatabaseHas('funcoes', [
            'id' => $funcao->id,
            'tenant_id' => 99,
            'nome' => 'Funcao Bloqueada',
        ]);
    }
}
