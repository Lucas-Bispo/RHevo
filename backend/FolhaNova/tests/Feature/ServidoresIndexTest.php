<?php

namespace Tests\Feature;

use App\Models\Cargo;
use App\Models\Lotacao;
use App\Models\Pessoa;
use App\Models\Servidor;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServidoresIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_open_servidores_index(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 10,
        ]);

        $lotacao = Lotacao::create([
            'tenant_id' => 10,
            'codigo' => 'SME',
            'nome' => 'Secretaria de Educacao',
            'tipo' => 'secretaria',
            'codigo_esocial' => '1005-EDU',
            'ativa' => true,
        ]);

        $cargo = Cargo::create([
            'tenant_id' => 10,
            'codigo' => 'PROF',
            'nome' => 'Professor Municipal',
            'codigo_cbo' => '2311-05',
            'codigo_esocial' => 'CARGO-PROF',
            'ativo' => true,
        ]);

        $pessoa = Pessoa::create([
            'tenant_id' => 10,
            'nome_completo' => 'Maria das Dores',
            'cpf' => '123.456.789-00',
            'data_nascimento' => '1990-05-10',
        ]);

        Servidor::create([
            'tenant_id' => 10,
            'pessoa_id' => $pessoa->id,
            'lotacao_id' => $lotacao->id,
            'cargo_id' => $cargo->id,
            'matricula' => '2026-0001',
            'tipo_vinculo' => 'estatutario',
            'categoria_esocial' => '301',
            'regime_previdenciario' => 'rp',
            'data_admissao' => '2026-02-01',
            'salario_base' => 4200,
            'situacao' => 'ativo',
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('servidores.index'));

        $response
            ->assertOk()
            ->assertSee('Servidores')
            ->assertSee('Maria das Dores')
            ->assertSee('2026-0001')
            ->assertSee('Pendentes de S-2200');
    }

    public function test_index_filters_results_by_search_and_tenant_scope(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 77,
        ]);

        $pessoaVisivel = Pessoa::create([
            'tenant_id' => 77,
            'nome_completo' => 'Carlos Alberto',
            'cpf' => '111.222.333-44',
        ]);

        $pessoaOculta = Pessoa::create([
            'tenant_id' => 88,
            'nome_completo' => 'Ana Beatriz',
            'cpf' => '555.666.777-88',
        ]);

        Servidor::create([
            'tenant_id' => 77,
            'pessoa_id' => $pessoaVisivel->id,
            'matricula' => 'MAT-77',
            'tipo_vinculo' => 'estatutario',
            'situacao' => 'ativo',
            'salario_base' => 3000,
        ]);

        Servidor::create([
            'tenant_id' => 88,
            'pessoa_id' => $pessoaOculta->id,
            'matricula' => 'MAT-88',
            'tipo_vinculo' => 'celetista',
            'situacao' => 'ativo',
            'salario_base' => 3000,
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('servidores.index', ['q' => 'Carlos']));

        $response
            ->assertOk()
            ->assertSee('Carlos Alberto')
            ->assertDontSee('Ana Beatriz')
            ->assertDontSee('MAT-88');
    }
}
