<?php

namespace Tests\Feature;

use App\Models\EventoEsocial;
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

        $evento = EventoEsocial::query()
            ->where('tenant_id', 51)
            ->where('evento', 'S-1040')
            ->where('status', 'pendente')
            ->firstOrFail();

        $this->assertNull($evento->servidor_id);
        $this->assertSame('funcoes', data_get($evento->payload, 'origem'));
        $this->assertSame('S1040-COORD', data_get($evento->payload, 'funcao.codigo_esocial'));
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

        $this->assertSame(0, EventoEsocial::query()->where('tenant_id', 52)->where('evento', 'S-1040')->count());
    }

    public function test_updating_ready_funcao_reuses_pending_s1040_event(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 56,
        ]);

        $funcao = Funcao::create([
            'tenant_id' => 56,
            'codigo' => 'DIR-01',
            'nome' => 'Diretor Escolar',
            'codigo_esocial' => 'S1040-DIR',
            'ativo' => true,
        ]);

        $evento = EventoEsocial::query()->create([
            'tenant_id' => 56,
            'servidor_id' => null,
            'evento' => 'S-1040',
            'status' => 'pendente',
            'ambiente' => 'homologacao',
            'payload' => [
                'evento' => 'S-1040',
                'origem' => 'funcoes',
                'funcao' => [
                    'id' => $funcao->id,
                    'nome' => 'Nome antigo',
                ],
            ],
        ]);

        $this
            ->actingAs($user)
            ->put(route('funcoes.update', $funcao), [
                'codigo' => 'DIR-01',
                'nome' => 'Diretor de Unidade Escolar',
                'descricao' => 'Gestao da unidade escolar',
                'codigo_esocial' => 'S1040-DIR',
                'ativo' => '1',
            ])
            ->assertRedirect(route('funcoes.index'));

        $this->assertSame(1, EventoEsocial::query()->where('tenant_id', 56)->where('evento', 'S-1040')->count());

        $evento->refresh();

        $this->assertSame('Diretor de Unidade Escolar', data_get($evento->payload, 'funcao.nome'));
        $this->assertSame('Gestao da unidade escolar', data_get($evento->payload, 'funcao.descricao'));
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

    public function test_user_cannot_create_funcao_with_duplicate_codigo_esocial_in_same_tenant(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 55,
        ]);

        Funcao::create([
            'tenant_id' => 55,
            'codigo' => 'COORD-BASE',
            'nome' => 'Coordenador Base',
            'codigo_esocial' => 'S1040-COORD',
            'ativo' => true,
        ]);

        $response = $this
            ->actingAs($user)
            ->from(route('funcoes.create'))
            ->post(route('funcoes.store'), [
                'codigo' => 'COORD-DUP',
                'nome' => 'Coordenador Duplicado',
                'descricao' => '',
                'codigo_esocial' => ' s1040-coord ',
                'ativo' => '1',
            ]);

        $response
            ->assertRedirect(route('funcoes.create'))
            ->assertSessionHasErrors('codigo_esocial');

        $this->assertSame(1, Funcao::query()->where('tenant_id', 55)->where('codigo_esocial', 'S1040-COORD')->count());
    }
}
