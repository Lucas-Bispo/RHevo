<?php

namespace Tests\Feature;

use App\Models\Cargo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CargoCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_open_cargo_creation_screen(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 40,
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('cargos.create'));

        $response
            ->assertOk()
            ->assertSee('Cadastro de cargo');
    }

    public function test_user_can_create_cargo(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 41,
        ]);

        $response = $this
            ->actingAs($user)
            ->post(route('cargos.store'), [
                'codigo' => 'PROF-001',
                'nome' => 'Professor Municipal',
                'descricao' => 'Cargo efetivo do magisterio',
                'codigo_esocial' => 'S1030-PROF',
                'ativo' => '1',
            ]);

        $response
            ->assertRedirect(route('cargos.index'))
            ->assertSessionHas('status');

        $this->assertDatabaseHas('cargos', [
            'tenant_id' => 41,
            'codigo' => 'PROF-001',
            'nome' => 'Professor Municipal',
            'codigo_esocial' => 'S1030-PROF',
            'ativo' => true,
        ]);
    }

    public function test_user_can_update_cargo(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 42,
        ]);

        $cargo = Cargo::create([
            'tenant_id' => 42,
            'codigo' => 'ADM-01',
            'nome' => 'Assistente Administrativo',
            'ativo' => true,
        ]);

        $response = $this
            ->actingAs($user)
            ->put(route('cargos.update', $cargo), [
                'codigo' => 'ADM-01',
                'nome' => 'Analista Administrativo',
                'descricao' => 'Atuacao ampliada no setor administrativo',
                'codigo_esocial' => 'S1030-ADM',
                'ativo' => '0',
            ]);

        $response
            ->assertRedirect(route('cargos.index'))
            ->assertSessionHas('status');

        $this->assertDatabaseHas('cargos', [
            'id' => $cargo->id,
            'nome' => 'Analista Administrativo',
            'codigo_esocial' => 'S1030-ADM',
            'ativo' => false,
        ]);
    }

    public function test_user_cannot_update_cargo_from_another_tenant(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 42,
        ]);

        $cargo = Cargo::create([
            'tenant_id' => 99,
            'codigo' => 'OUT-01',
            'nome' => 'Cargo Bloqueado',
            'ativo' => true,
        ]);

        $response = $this
            ->actingAs($user)
            ->put(route('cargos.update', $cargo), [
                'codigo' => 'OUT-01',
                'nome' => 'Tentativa Invalida',
                'descricao' => 'Nao deveria atualizar',
                'codigo_esocial' => 'S1030-OUT',
                'ativo' => '0',
            ]);

        $response->assertForbidden();

        $this->assertDatabaseHas('cargos', [
            'id' => $cargo->id,
            'tenant_id' => 99,
            'nome' => 'Cargo Bloqueado',
        ]);
    }
}
