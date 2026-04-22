<?php

namespace Tests\Feature;

use App\Models\EventoEsocial;
use App\Models\Pessoa;
use App\Models\Servidor;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventosEsocialIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_open_eventos_esocial_index(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 70,
        ]);

        $pessoa = Pessoa::create([
            'tenant_id' => 70,
            'nome_completo' => 'Marina Souza',
            'cpf' => '123.456.789-01',
        ]);

        $servidor = Servidor::create([
            'tenant_id' => 70,
            'pessoa_id' => $pessoa->id,
            'matricula' => 'MAT-7001',
            'tipo_vinculo' => 'estatutario',
            'data_admissao' => '2026-04-20',
            'salario_base' => 4500,
            'situacao' => 'ativo',
        ]);

        EventoEsocial::create([
            'tenant_id' => 70,
            'servidor_id' => $servidor->id,
            'evento' => 'S-2200',
            'status' => 'pendente',
            'ambiente' => 'homologacao',
            'payload' => ['origem' => 'cadastro_inicial_servidor'],
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('eventos-esocial.index'));

        $response
            ->assertOk()
            ->assertSee('Eventos eSocial')
            ->assertSee('S-2200')
            ->assertSee('Marina Souza');
    }

    public function test_eventos_index_is_scoped_to_current_tenant(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 71,
        ]);

        EventoEsocial::create([
            'tenant_id' => 71,
            'evento' => 'S-1000',
            'status' => 'pendente',
            'ambiente' => 'homologacao',
            'payload' => ['origem' => 'parametros_orgao_publico'],
        ]);

        EventoEsocial::create([
            'tenant_id' => 72,
            'evento' => 'S-1010',
            'status' => 'erro',
            'ambiente' => 'producao',
            'payload' => ['origem' => 'rubricas'],
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('eventos-esocial.index'));

        $response
            ->assertOk()
            ->assertSee('S-1000')
            ->assertDontSee('S-1010');
    }

    public function test_eventos_index_shows_error_summary_for_current_tenant(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 78,
        ]);

        EventoEsocial::create([
            'tenant_id' => 78,
            'evento' => 'S-1000',
            'status' => 'erro',
            'ambiente' => 'homologacao',
            'mensagem_retorno' => 'Erro de validacao local.',
            'payload' => ['origem' => 'parametros_orgao_publico'],
        ]);

        EventoEsocial::create([
            'tenant_id' => 79,
            'evento' => 'S-1010',
            'status' => 'erro',
            'ambiente' => 'homologacao',
            'payload' => ['origem' => 'rubricas'],
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('eventos-esocial.index'));

        $response
            ->assertOk()
            ->assertSee('Com erro')
            ->assertSee('Prioridade para reprocessamento')
            ->assertSee('>1<', false);
    }
}
