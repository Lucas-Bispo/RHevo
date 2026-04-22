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
            'payload' => ['origem' => 'tenant_72_payload_marker'],
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('eventos-esocial.index'));

        $response
            ->assertOk()
            ->assertSee('S-1000')
            ->assertDontSee('tenant_72_payload_marker');
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
            ->assertSee('href="'.route('eventos-esocial.index', ['status' => 'erro']).'"', false)
            ->assertSee('>1<', false);
    }

    public function test_eventos_index_links_pending_summary_to_pending_filter(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 80,
        ]);

        EventoEsocial::create([
            'tenant_id' => 80,
            'evento' => 'S-1000',
            'status' => 'pendente',
            'ambiente' => 'homologacao',
            'payload' => ['origem' => 'parametros_orgao_publico'],
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('eventos-esocial.index'));

        $response
            ->assertOk()
            ->assertSee('Pendentes')
            ->assertSee('Fila aguardando processamento')
            ->assertSee('href="'.route('eventos-esocial.index', ['status' => 'pendente']).'"', false);
    }

    public function test_eventos_index_links_processed_summary_to_processed_filter(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 81,
        ]);

        EventoEsocial::create([
            'tenant_id' => 81,
            'evento' => 'S-1000',
            'status' => 'processado',
            'ambiente' => 'homologacao',
            'protocolo' => 'PROTO-81',
            'recibo' => 'REC-81',
            'payload' => ['origem' => 'parametros_orgao_publico'],
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('eventos-esocial.index'));

        $response
            ->assertOk()
            ->assertSee('Processados')
            ->assertSee('Com trilha de retorno')
            ->assertSee('href="'.route('eventos-esocial.index', ['status' => 'processado']).'"', false);
    }

    public function test_eventos_index_links_priority_event_summaries_to_event_filters(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 82,
        ]);

        EventoEsocial::create([
            'tenant_id' => 82,
            'evento' => 'S-1000',
            'status' => 'pendente',
            'ambiente' => 'homologacao',
            'payload' => ['origem' => 'parametros_orgao_publico'],
        ]);

        EventoEsocial::create([
            'tenant_id' => 82,
            'evento' => 'S-1010',
            'status' => 'erro',
            'ambiente' => 'homologacao',
            'payload' => ['origem' => 'rubricas'],
        ]);

        EventoEsocial::create([
            'tenant_id' => 82,
            'evento' => 'S-2200',
            'status' => 'pendente',
            'ambiente' => 'homologacao',
            'payload' => ['origem' => 'cadastro_inicial_servidor'],
        ]);

        $this
            ->actingAs($user)
            ->get(route('eventos-esocial.index'))
            ->assertOk()
            ->assertSee('href="'.route('eventos-esocial.index', ['evento' => 'S-1000']).'"', false)
            ->assertSee('href="'.route('eventos-esocial.index', ['evento' => 'S-1010']).'"', false)
            ->assertSee('href="'.route('eventos-esocial.index', ['evento' => 'S-2200']).'"', false);

        $this
            ->actingAs($user)
            ->get(route('eventos-esocial.index', ['evento' => 'S-1010']))
            ->assertOk()
            ->assertSee('S-1010')
            ->assertDontSee('parametros_orgao_publico')
            ->assertDontSee('cadastro_inicial_servidor')
            ->assertSee('value="S-1010" selected', false);
    }

    public function test_eventos_index_can_filter_events_with_return_message(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 83,
        ]);

        EventoEsocial::create([
            'tenant_id' => 83,
            'evento' => 'S-1000',
            'status' => 'processado',
            'ambiente' => 'homologacao',
            'mensagem_retorno' => 'Evento recebido com sucesso.',
            'payload' => ['origem' => 'parametros_orgao_publico'],
        ]);

        EventoEsocial::create([
            'tenant_id' => 83,
            'evento' => 'S-2200',
            'status' => 'pendente',
            'ambiente' => 'homologacao',
            'mensagem_retorno' => null,
            'payload' => ['origem' => 'cadastro_inicial_servidor'],
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('eventos-esocial.index', ['retorno' => 'com_mensagem']));

        $response
            ->assertOk()
            ->assertSee('Com retorno')
            ->assertSee('Mensagens registradas')
            ->assertSee('parametros_orgao_publico')
            ->assertDontSee('cadastro_inicial_servidor')
            ->assertSee('href="'.route('eventos-esocial.index', ['retorno' => 'com_mensagem']).'"', false);
    }

    public function test_eventos_index_shows_active_filters_summary(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 86,
        ]);

        EventoEsocial::create([
            'tenant_id' => 86,
            'evento' => 'S-1000',
            'status' => 'erro',
            'ambiente' => 'homologacao',
            'mensagem_retorno' => 'Retorno institucional.',
            'payload' => ['origem' => 'parametros_orgao_publico'],
        ]);

        $this
            ->actingAs($user)
            ->get(route('eventos-esocial.index', [
                'q' => 'S-1000',
                'evento' => 'S-1000',
                'status' => 'erro',
                'ambiente' => 'homologacao',
                'retorno' => 'com_mensagem',
            ]))
            ->assertOk()
            ->assertSee('Filtros ativos')
            ->assertSee('Busca: S-1000')
            ->assertSee('Evento: S-1000')
            ->assertSee('Status: Erro')
            ->assertSee('Ambiente: Homologacao')
            ->assertSee('Retorno: Com mensagem')
            ->assertSee('href="'.route('eventos-esocial.index').'"', false);
    }

    public function test_eventos_index_shows_return_summary_in_listing(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 85,
        ]);

        EventoEsocial::create([
            'tenant_id' => 85,
            'evento' => 'S-1010',
            'status' => 'erro',
            'ambiente' => 'homologacao',
            'mensagem_retorno' => 'Rubrica sem natureza eSocial compativel com a parametrizacao atual.',
            'payload' => ['origem' => 'rubricas'],
        ]);

        EventoEsocial::create([
            'tenant_id' => 85,
            'evento' => 'S-2200',
            'status' => 'pendente',
            'ambiente' => 'homologacao',
            'mensagem_retorno' => null,
            'payload' => ['origem' => 'cadastro_inicial_servidor'],
        ]);

        $this
            ->actingAs($user)
            ->get(route('eventos-esocial.index'))
            ->assertOk()
            ->assertSee('Retorno')
            ->assertSee('Rubrica sem natureza eSocial compativel')
            ->assertSee('Sem retorno registrado');
    }

    public function test_eventos_index_shows_reprocess_action_only_for_failed_events(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 84,
        ]);

        $eventoComErro = EventoEsocial::create([
            'tenant_id' => 84,
            'evento' => 'S-1010',
            'status' => 'erro',
            'ambiente' => 'homologacao',
            'mensagem_retorno' => 'Falha de validacao local.',
            'payload' => ['origem' => 'rubricas'],
        ]);

        $eventoProcessado = EventoEsocial::create([
            'tenant_id' => 84,
            'evento' => 'S-1000',
            'status' => 'processado',
            'ambiente' => 'homologacao',
            'payload' => ['origem' => 'parametros_orgao_publico'],
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('eventos-esocial.index'));

        $response
            ->assertOk()
            ->assertSee('Reprocessar')
            ->assertSee('action="'.route('eventos-esocial.reprocessar', $eventoComErro).'"', false)
            ->assertDontSee('action="'.route('eventos-esocial.reprocessar', $eventoProcessado).'"', false);
    }
}
