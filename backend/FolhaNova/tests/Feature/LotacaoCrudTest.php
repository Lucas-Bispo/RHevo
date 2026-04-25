<?php

namespace Tests\Feature;

use App\Models\Lotacao;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LotacaoCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_open_lotacao_creation_screen(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 30,
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('lotacoes.create'));

        $response
            ->assertOk()
            ->assertSee('Cadastro de lotacao');
    }

    public function test_user_can_create_lotacao(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 31,
        ]);

        $response = $this
            ->actingAs($user)
            ->post(route('lotacoes.store'), [
                'codigo' => 'FIN-001',
                'nome' => 'Secretaria de Financas',
                'tipo' => 'secretaria',
                'codigo_esocial' => 'S1005-FIN',
                'ativa' => '1',
            ]);

        $response
            ->assertRedirect(route('lotacoes.index'))
            ->assertSessionHas('status');

        $this->assertDatabaseHas('lotacoes', [
            'tenant_id' => 31,
            'codigo' => 'FIN-001',
            'nome' => 'Secretaria de Financas',
            'tipo' => 'secretaria',
            'codigo_esocial' => 'S1005-FIN',
            'ativa' => true,
        ]);
    }

    public function test_user_can_update_lotacao(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 32,
        ]);

        $lotacao = Lotacao::create([
            'tenant_id' => 32,
            'codigo' => 'ADM-01',
            'nome' => 'Administracao Geral',
            'tipo' => 'departamento',
            'ativa' => true,
        ]);

        $response = $this
            ->actingAs($user)
            ->put(route('lotacoes.update', $lotacao), [
                'codigo' => 'ADM-01',
                'nome' => 'Administracao Central',
                'tipo' => 'gabinete',
                'codigo_esocial' => 'S1005-ADM',
                'ativa' => '0',
            ]);

        $response
            ->assertRedirect(route('lotacoes.index'))
            ->assertSessionHas('status');

        $this->assertDatabaseHas('lotacoes', [
            'id' => $lotacao->id,
            'nome' => 'Administracao Central',
            'tipo' => 'gabinete',
            'codigo_esocial' => 'S1005-ADM',
            'ativa' => false,
        ]);
    }

    public function test_user_cannot_update_lotacao_from_another_tenant(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 32,
        ]);

        $lotacao = Lotacao::create([
            'tenant_id' => 99,
            'codigo' => 'OUT-LOT',
            'nome' => 'Lotacao Bloqueada',
            'tipo' => 'departamento',
            'ativa' => true,
        ]);

        $response = $this
            ->actingAs($user)
            ->put(route('lotacoes.update', $lotacao), [
                'codigo' => 'OUT-LOT',
                'nome' => 'Tentativa Invalida',
                'tipo' => 'gabinete',
                'codigo_esocial' => 'S1005-OUT',
                'ativa' => '0',
            ]);

        $response->assertForbidden();

        $this->assertDatabaseHas('lotacoes', [
            'id' => $lotacao->id,
            'tenant_id' => 99,
            'nome' => 'Lotacao Bloqueada',
        ]);
    }
}
