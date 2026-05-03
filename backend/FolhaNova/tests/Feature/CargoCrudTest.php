<?php

namespace Tests\Feature;

use App\Models\Cargo;
use App\Models\EventoEsocial;
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

        $evento = EventoEsocial::query()
            ->where('tenant_id', 41)
            ->where('evento', 'S-1030')
            ->where('status', 'pendente')
            ->firstOrFail();

        $this->assertNull($evento->servidor_id);
        $this->assertSame('cargos', data_get($evento->payload, 'origem'));
        $this->assertSame('S1030-PROF', data_get($evento->payload, 'cargo.codigo_esocial'));
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

        $this->assertSame(0, EventoEsocial::query()->where('tenant_id', 42)->where('evento', 'S-1030')->count());
    }

    public function test_updating_ready_cargo_reuses_pending_s1030_event(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 46,
        ]);

        $cargo = Cargo::create([
            'tenant_id' => 46,
            'codigo' => 'TEC-01',
            'nome' => 'Tecnico Administrativo',
            'codigo_esocial' => 'S1030-TEC',
            'ativo' => true,
        ]);

        $evento = EventoEsocial::query()->create([
            'tenant_id' => 46,
            'servidor_id' => null,
            'evento' => 'S-1030',
            'status' => 'pendente',
            'ambiente' => 'homologacao',
            'payload' => [
                'evento' => 'S-1030',
                'origem' => 'cargos',
                'cargo' => [
                    'id' => $cargo->id,
                    'nome' => 'Nome antigo',
                ],
            ],
        ]);

        $this
            ->actingAs($user)
            ->put(route('cargos.update', $cargo), [
                'codigo' => 'TEC-01',
                'nome' => 'Tecnico de Administracao Municipal',
                'descricao' => 'Atuacao tecnica atualizada',
                'codigo_esocial' => 'S1030-TEC',
                'ativo' => '1',
            ])
            ->assertRedirect(route('cargos.index'));

        $this->assertSame(1, EventoEsocial::query()->where('tenant_id', 46)->where('evento', 'S-1030')->count());

        $evento->refresh();

        $this->assertSame('Tecnico de Administracao Municipal', data_get($evento->payload, 'cargo.nome'));
        $this->assertSame('Atuacao tecnica atualizada', data_get($evento->payload, 'cargo.descricao'));
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

    public function test_user_cannot_create_cargo_with_duplicate_codigo_esocial_in_same_tenant(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 45,
        ]);

        Cargo::create([
            'tenant_id' => 45,
            'codigo' => 'PROF-BASE',
            'nome' => 'Professor Base',
            'codigo_esocial' => 'S1030-PROF',
            'ativo' => true,
        ]);

        $response = $this
            ->actingAs($user)
            ->from(route('cargos.create'))
            ->post(route('cargos.store'), [
                'codigo' => 'PROF-DUP',
                'nome' => 'Professor Duplicado',
                'descricao' => '',
                'codigo_esocial' => ' s1030-prof ',
                'ativo' => '1',
            ]);

        $response
            ->assertRedirect(route('cargos.create'))
            ->assertSessionHasErrors('codigo_esocial');

        $this->assertSame(1, Cargo::query()->where('tenant_id', 45)->where('codigo_esocial', 'S1030-PROF')->count());
    }
}
