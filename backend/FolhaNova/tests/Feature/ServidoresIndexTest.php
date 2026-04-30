<?php

namespace Tests\Feature;

use App\Models\Cargo;
use App\Models\EventoEsocial;
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
            ->assertSee('Pendentes de S-2200')
            ->assertSee('S-2205 planejado')
            ->assertDontSee('servidores.edit-cadastral');
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

    public function test_index_filters_servidores_by_s2200_readiness(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 79,
        ]);

        $lotacao = Lotacao::create([
            'tenant_id' => 79,
            'codigo' => 'ADM',
            'nome' => 'Administracao',
            'tipo' => 'secretaria',
            'codigo_esocial' => 'S1020-ADM',
            'ativa' => true,
        ]);

        $cargo = Cargo::create([
            'tenant_id' => 79,
            'codigo' => 'ANL',
            'nome' => 'Analista Administrativo',
            'codigo_esocial' => 'S1030-ANL',
            'ativo' => true,
        ]);

        $pessoaPronta = Pessoa::create([
            'tenant_id' => 79,
            'nome_completo' => 'Servidor Pronto',
            'cpf' => '529.982.247-25',
            'data_nascimento' => '1991-04-20',
        ]);

        $servidorPronto = Servidor::create([
            'tenant_id' => 79,
            'pessoa_id' => $pessoaPronta->id,
            'lotacao_id' => $lotacao->id,
            'cargo_id' => $cargo->id,
            'matricula' => 'S2200-OK',
            'tipo_vinculo' => 'estatutario',
            'categoria_esocial' => '301',
            'regime_previdenciario' => 'rp',
            'data_admissao' => '2026-04-01',
            'salario_base' => 5000,
            'situacao' => 'ativo',
        ]);

        EventoEsocial::create([
            'tenant_id' => 79,
            'servidor_id' => $servidorPronto->id,
            'evento' => 'S-2200',
            'status' => 'pendente',
            'ambiente' => 'homologacao',
        ]);

        $pessoaPendente = Pessoa::create([
            'tenant_id' => 79,
            'nome_completo' => 'Servidor Pendente',
            'cpf' => '111.444.777-35',
        ]);

        Servidor::create([
            'tenant_id' => 79,
            'pessoa_id' => $pessoaPendente->id,
            'matricula' => 'S2200-PEND',
            'tipo_vinculo' => 'estatutario',
            'categoria_esocial' => null,
            'regime_previdenciario' => null,
            'data_admissao' => null,
            'salario_base' => 3000,
            'situacao' => 'ativo',
        ]);

        $this
            ->actingAs($user)
            ->get(route('servidores.index', ['prontidao' => 'pronto']))
            ->assertOk()
            ->assertSee('Prontos S-2200')
            ->assertSee('Servidor Pronto')
            ->assertDontSee('Servidor Pendente')
            ->assertSee('Prontidao S-2200: Prontos');

        $this
            ->actingAs($user)
            ->get(route('servidores.index', ['prontidao' => 'pendente']))
            ->assertOk()
            ->assertSee('Pendencias S-2200')
            ->assertSee('Servidor Pendente')
            ->assertDontSee('Servidor Pronto')
            ->assertSee('Prontidao S-2200: Pendencias');
    }

    public function test_contract_edit_screen_marks_s2205_as_planned_without_broken_route(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 78,
        ]);

        $pessoa = Pessoa::create([
            'tenant_id' => 78,
            'nome_completo' => 'Helena Costa',
            'cpf' => '529.982.247-25',
        ]);

        $servidor = Servidor::create([
            'tenant_id' => 78,
            'pessoa_id' => $pessoa->id,
            'matricula' => 'MAT-7801',
            'tipo_vinculo' => 'estatutario',
            'situacao' => 'ativo',
            'salario_base' => 4500,
        ]);

        $this
            ->actingAs($user)
            ->get(route('servidores.edit', $servidor))
            ->assertOk()
            ->assertSee('Alteracao contratual do trabalhador')
            ->assertSee('S-2205 em planejamento')
            ->assertDontSee('servidores.edit-cadastral');
    }
}
