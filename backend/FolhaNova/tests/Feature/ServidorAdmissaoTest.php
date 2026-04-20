<?php

namespace Tests\Feature;

use App\Models\Cargo;
use App\Models\EventoEsocial;
use App\Models\Funcao;
use App\Models\Lotacao;
use App\Models\Pessoa;
use App\Models\Servidor;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServidorAdmissaoTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_open_servidor_creation_screen(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 50,
        ]);

        $lotacao = Lotacao::create([
            'tenant_id' => 50,
            'codigo' => 'FIN',
            'nome' => 'Secretaria de Financas',
            'tipo' => 'secretaria',
            'ativa' => true,
        ]);

        $cargo = Cargo::create([
            'tenant_id' => 50,
            'codigo' => 'ANF',
            'nome' => 'Analista Fazendario',
            'ativo' => true,
        ]);

        $funcao = Funcao::create([
            'tenant_id' => 50,
            'codigo' => 'COORD',
            'nome' => 'Coordenador',
            'ativo' => true,
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('servidores.create'));

        $response
            ->assertOk()
            ->assertSee('Nova admissao')
            ->assertSee($lotacao->nome)
            ->assertSee($cargo->nome)
            ->assertSee($funcao->nome);
    }

    public function test_user_can_register_servidor_admissao_and_generate_pending_esocial_event(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 99,
        ]);

        $lotacao = Lotacao::create([
            'tenant_id' => 99,
            'codigo' => 'EDU',
            'nome' => 'Secretaria de Educacao',
            'tipo' => 'secretaria',
            'ativa' => true,
        ]);

        $cargo = Cargo::create([
            'tenant_id' => 99,
            'codigo' => 'PROF',
            'nome' => 'Professor Municipal',
            'ativo' => true,
        ]);

        $response = $this
            ->actingAs($user)
            ->post(route('servidores.store'), [
                'nome_completo' => 'Marina Souza',
                'cpf' => '12345678901',
                'data_nascimento' => '1992-08-21',
                'email' => 'marina.souza@prefeitura.gov.br',
                'telefone' => '11999990000',
                'matricula' => 'ADM-0001',
                'tipo_vinculo' => 'estatutario',
                'categoria_esocial' => '301',
                'regime_previdenciario' => 'rpps',
                'lotacao_id' => $lotacao->id,
                'cargo_id' => $cargo->id,
                'data_admissao' => '2026-04-20',
                'salario_base' => '5875.42',
                'situacao' => 'ativo',
                'ambiente_esocial' => 'homologacao',
            ]);

        $response
            ->assertRedirect(route('servidores.index'))
            ->assertSessionHas('status');

        $this->assertDatabaseHas('pessoas', [
            'tenant_id' => 99,
            'nome_completo' => 'Marina Souza',
            'cpf' => '123.456.789-01',
        ]);

        $this->assertDatabaseHas('servidores', [
            'tenant_id' => 99,
            'matricula' => 'ADM-0001',
            'tipo_vinculo' => 'estatutario',
            'categoria_esocial' => '301',
            'situacao' => 'ativo',
        ]);

        $this->assertDatabaseHas('eventos_esocial', [
            'tenant_id' => 99,
            'evento' => 'S-2200',
            'status' => 'pendente',
            'ambiente' => 'homologacao',
        ]);
    }
}
