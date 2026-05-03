<?php

namespace Tests\Feature;

use App\Models\EventoEsocial;
use App\Models\Lotacao;
use App\Models\Pessoa;
use App\Models\Servidor;
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
            ->assertSee('Cadastro de lotacao')
            ->assertSee('Setor')
            ->assertSee('Departamento')
            ->assertSee('Secretaria')
            ->assertSee('Unidade')
            ->assertSee('Gabinete');
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

    public function test_creating_ready_lotacao_generates_pending_s1020_event(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 36,
        ]);

        $this
            ->actingAs($user)
            ->post(route('lotacoes.store'), [
                'codigo' => 'TRB-001',
                'nome' => 'Secretaria de Trabalho',
                'tipo' => 'secretaria',
                'codigo_esocial' => 's1020-trb',
                'ativa' => '1',
            ])
            ->assertRedirect(route('lotacoes.index'));

        $lotacao = Lotacao::query()->where('tenant_id', 36)->where('codigo', 'TRB-001')->firstOrFail();
        $evento = EventoEsocial::query()->where('tenant_id', 36)->where('evento', 'S-1020')->firstOrFail();

        $this->assertSame('pendente', $evento->status);
        $this->assertSame('homologacao', $evento->ambiente);
        $this->assertSame('lotacoes', data_get($evento->payload, 'origem'));
        $this->assertSame($lotacao->id, data_get($evento->payload, 'lotacao.id'));
        $this->assertSame('S1020-TRB', data_get($evento->payload, 'lotacao.codigo_esocial'));
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

    public function test_updating_ready_lotacao_reuses_pending_s1020_event(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 37,
        ]);

        $lotacao = Lotacao::create([
            'tenant_id' => 37,
            'codigo' => 'ADM-37',
            'nome' => 'Administracao Geral',
            'tipo' => 'departamento',
            'codigo_esocial' => 'S1020-ADM',
            'ativa' => true,
        ]);

        $evento = EventoEsocial::create([
            'tenant_id' => 37,
            'servidor_id' => null,
            'evento' => 'S-1020',
            'status' => 'pendente',
            'ambiente' => 'homologacao',
            'payload' => [
                'origem' => 'lotacoes',
                'lotacao' => [
                    'id' => $lotacao->id,
                    'nome' => 'Administracao Geral',
                    'codigo_esocial' => 'S1020-ADM',
                ],
            ],
        ]);

        $this
            ->actingAs($user)
            ->put(route('lotacoes.update', $lotacao), [
                'codigo' => 'ADM-37',
                'nome' => 'Administracao Central',
                'tipo' => 'gabinete',
                'codigo_esocial' => 'S1020-ADM-CENTRAL',
                'ativa' => '1',
            ])
            ->assertRedirect(route('lotacoes.index'));

        $this->assertSame(1, EventoEsocial::query()->where('tenant_id', 37)->where('evento', 'S-1020')->count());

        $evento->refresh();

        $this->assertSame('Administracao Central', data_get($evento->payload, 'lotacao.nome'));
        $this->assertSame('gabinete', data_get($evento->payload, 'lotacao.tipo'));
        $this->assertSame('S1020-ADM-CENTRAL', data_get($evento->payload, 'lotacao.codigo_esocial'));
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

    public function test_user_cannot_deactivate_lotacao_with_active_servidores(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 35,
        ]);

        $lotacao = Lotacao::create([
            'tenant_id' => 35,
            'codigo' => 'SAU-01',
            'nome' => 'Secretaria de Saude',
            'tipo' => 'secretaria',
            'codigo_esocial' => 'S1020-SAU',
            'ativa' => true,
        ]);

        $pessoa = Pessoa::create([
            'tenant_id' => 35,
            'nome_completo' => 'Aline Cardoso',
            'cpf' => '529.982.247-25',
        ]);

        Servidor::create([
            'tenant_id' => 35,
            'pessoa_id' => $pessoa->id,
            'lotacao_id' => $lotacao->id,
            'matricula' => 'MAT-3501',
            'tipo_vinculo' => 'estatutario',
            'data_admissao' => '2026-04-01',
            'salario_base' => 4200,
            'situacao' => 'ativo',
        ]);

        $response = $this
            ->actingAs($user)
            ->from(route('lotacoes.edit', $lotacao))
            ->put(route('lotacoes.update', $lotacao), [
                'codigo' => 'SAU-01',
                'nome' => 'Secretaria de Saude',
                'tipo' => 'secretaria',
                'codigo_esocial' => 'S1020-SAU',
                'ativa' => '0',
            ]);

        $response
            ->assertRedirect(route('lotacoes.edit', $lotacao))
            ->assertSessionHasErrors('ativa');

        $this->assertTrue($lotacao->fresh()->ativa);
    }

    public function test_user_cannot_create_lotacao_with_unsupported_type(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 33,
        ]);

        $response = $this
            ->actingAs($user)
            ->from(route('lotacoes.create'))
            ->post(route('lotacoes.store'), [
                'codigo' => 'LOT-EXT',
                'nome' => 'Lotacao externa',
                'tipo' => 'externa',
                'codigo_esocial' => 'S1020-EXT',
                'ativa' => '1',
            ]);

        $response
            ->assertRedirect(route('lotacoes.create'))
            ->assertSessionHasErrors('tipo');

        $this->assertDatabaseMissing('lotacoes', [
            'tenant_id' => 33,
            'codigo' => 'LOT-EXT',
        ]);
    }

    public function test_user_cannot_create_lotacao_with_duplicate_codigo_esocial_in_same_tenant(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 34,
        ]);

        Lotacao::create([
            'tenant_id' => 34,
            'codigo' => 'EDU-BASE',
            'nome' => 'Secretaria de Educacao Base',
            'tipo' => 'secretaria',
            'codigo_esocial' => 'S1020-EDU',
            'ativa' => true,
        ]);

        $response = $this
            ->actingAs($user)
            ->from(route('lotacoes.create'))
            ->post(route('lotacoes.store'), [
                'codigo' => 'EDU-DUP',
                'nome' => 'Secretaria de Educacao Duplicada',
                'tipo' => 'secretaria',
                'codigo_esocial' => ' s1020-edu ',
                'ativa' => '1',
            ]);

        $response
            ->assertRedirect(route('lotacoes.create'))
            ->assertSessionHasErrors('codigo_esocial');

        $this->assertSame(1, Lotacao::query()->where('tenant_id', 34)->where('codigo_esocial', 'S1020-EDU')->count());
    }
}
