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

    public function test_eventos_index_can_open_local_reprocessing_queue(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 96,
        ]);

        EventoEsocial::create([
            'tenant_id' => 96,
            'evento' => 'S-1000',
            'status' => 'erro',
            'ambiente' => 'homologacao',
            'mensagem_retorno' => 'Falha de validacao institucional.',
            'payload' => ['origem' => 'parametros_orgao_publico'],
        ]);

        EventoEsocial::create([
            'tenant_id' => 96,
            'evento' => 'S-1010',
            'status' => 'processado',
            'ambiente' => 'homologacao',
            'mensagem_retorno' => 'Evento aceito.',
            'payload' => ['origem' => 'rubricas'],
        ]);

        $this
            ->actingAs($user)
            ->get(route('eventos-esocial.index'))
            ->assertOk()
            ->assertSee('Reprocessamento')
            ->assertSee('Eventos prontos para reenfileirar')
            ->assertSee('href="'.route('eventos-esocial.index', ['acao' => 'reprocessamento']).'"', false);

        $this
            ->actingAs($user)
            ->get(route('eventos-esocial.index', ['acao' => 'reprocessamento']))
            ->assertOk()
            ->assertSee('Acao: Reprocessamento local')
            ->assertSee('value="reprocessamento" selected', false)
            ->assertSee('Falha de validacao institucional.')
            ->assertDontSee('Evento aceito.')
            ->assertViewHas('eventos', fn ($eventos) => $eventos->getCollection()->every(
                fn ($evento) => $evento->status === 'erro'
            ));
    }

    public function test_eventos_index_links_recent_day_summaries_to_status_and_date_filters(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 95,
        ]);

        $eventoPendenteHoje = EventoEsocial::create([
            'tenant_id' => 95,
            'evento' => 'S-1000',
            'status' => 'pendente',
            'ambiente' => 'homologacao',
            'payload' => ['origem' => 'parametros_orgao_publico'],
        ]);

        $eventoErroHoje = EventoEsocial::create([
            'tenant_id' => 95,
            'evento' => 'S-1010',
            'status' => 'erro',
            'ambiente' => 'homologacao',
            'payload' => ['origem' => 'rubricas'],
        ]);

        EventoEsocial::create([
            'tenant_id' => 95,
            'evento' => 'S-2200',
            'status' => 'pendente',
            'ambiente' => 'homologacao',
            'payload' => ['origem' => 'cadastro_inicial_servidor'],
        ])->forceFill([
            'updated_at' => now()->subDay(),
        ])->saveQuietly();

        $eventoPendenteHoje->forceFill([
            'updated_at' => now()->setTime(9, 10),
        ])->saveQuietly();

        $eventoErroHoje->forceFill([
            'updated_at' => now()->setTime(11, 45),
        ])->saveQuietly();

        $hoje = now()->toDateString();

        $this
            ->actingAs($user)
            ->get(route('eventos-esocial.index'))
            ->assertOk()
            ->assertSee('Pendentes hoje')
            ->assertSee('Erros hoje')
            ->assertSee('Fila recente do dia')
            ->assertSee('Prioridades abertas no dia')
            ->assertSee('status=pendente', false)
            ->assertSee('status=erro', false)
            ->assertSee('data='.$hoje, false);

        $this
            ->actingAs($user)
            ->get(route('eventos-esocial.index', ['status' => 'erro', 'data' => $hoje]))
            ->assertOk()
            ->assertSee('Status: Erro')
            ->assertSee('Data: '.now()->format('d/m/Y'))
            ->assertViewHas('eventos', fn ($eventos) => $eventos->getCollection()->every(
                fn ($evento) => $evento->status === 'erro' && optional($evento->updated_at)->toDateString() === $hoje
            ));
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
            'evento' => 'S-1005',
            'status' => 'pendente',
            'ambiente' => 'homologacao',
            'payload' => ['origem' => 'estabelecimentos'],
        ]);

        EventoEsocial::create([
            'tenant_id' => 82,
            'evento' => 'S-1020',
            'status' => 'pendente',
            'ambiente' => 'homologacao',
            'payload' => ['origem' => 'lotacoes_tributarias'],
        ]);

        EventoEsocial::create([
            'tenant_id' => 82,
            'evento' => 'S-1030',
            'status' => 'pendente',
            'ambiente' => 'homologacao',
            'payload' => ['origem' => 'cargos'],
        ]);

        EventoEsocial::create([
            'tenant_id' => 82,
            'evento' => 'S-1040',
            'status' => 'pendente',
            'ambiente' => 'homologacao',
            'payload' => ['origem' => 'funcoes'],
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
            ->assertSee('href="'.route('eventos-esocial.index', ['evento' => 'S-1005']).'"', false)
            ->assertSee('href="'.route('eventos-esocial.index', ['evento' => 'S-1010']).'"', false)
            ->assertSee('href="'.route('eventos-esocial.index', ['evento' => 'S-1020']).'"', false)
            ->assertSee('href="'.route('eventos-esocial.index', ['evento' => 'S-1030']).'"', false)
            ->assertSee('href="'.route('eventos-esocial.index', ['evento' => 'S-1040']).'"', false)
            ->assertSee('href="'.route('eventos-esocial.index', ['evento' => 'S-2200']).'"', false);

        $this
            ->actingAs($user)
            ->get(route('eventos-esocial.index', ['evento' => 'S-1020']))
            ->assertOk()
            ->assertSee('S-1020')
            ->assertSee('lotacoes_tributarias')
            ->assertViewHas('eventos', fn ($eventos) => $eventos->getCollection()->pluck('evento')->all() === ['S-1020'])
            ->assertSee('value="S-1020" selected', false);
    }

    public function test_eventos_index_can_filter_by_esocial_group(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 97,
        ]);

        EventoEsocial::create([
            'tenant_id' => 97,
            'evento' => 'S-1000',
            'status' => 'pendente',
            'ambiente' => 'homologacao',
            'payload' => ['origem' => 'parametros_orgao_publico'],
        ]);

        EventoEsocial::create([
            'tenant_id' => 97,
            'evento' => 'S-1010',
            'status' => 'pendente',
            'ambiente' => 'homologacao',
            'payload' => ['origem' => 'rubricas'],
        ]);

        EventoEsocial::create([
            'tenant_id' => 97,
            'evento' => 'S-2200',
            'status' => 'pendente',
            'ambiente' => 'homologacao',
            'payload' => ['origem' => 'cadastro_inicial_servidor'],
        ]);

        EventoEsocial::create([
            'tenant_id' => 97,
            'evento' => 'S-1202',
            'status' => 'pendente',
            'ambiente' => 'homologacao',
            'payload' => ['origem' => 'folha_rpps'],
        ]);

        $this
            ->actingAs($user)
            ->get(route('eventos-esocial.index'))
            ->assertOk()
            ->assertSee('Eventos de tabela')
            ->assertSee('Nao periodicos')
            ->assertSee('Periodicos')
            ->assertSee('href="'.route('eventos-esocial.index', ['grupo' => 'tabelas']).'"', false)
            ->assertSee('href="'.route('eventos-esocial.index', ['grupo' => 'nao_periodicos']).'"', false)
            ->assertSee('href="'.route('eventos-esocial.index', ['grupo' => 'periodicos']).'"', false);

        $this
            ->actingAs($user)
            ->get(route('eventos-esocial.index', ['grupo' => 'tabelas']))
            ->assertOk()
            ->assertSee('Grupo: Eventos de tabela')
            ->assertSee('parametros_orgao_publico')
            ->assertSee('rubricas')
            ->assertViewHas('eventos', fn ($eventos) => $eventos->getCollection()->pluck('evento')->every(
                fn ($evento) => in_array($evento, ['S-1000', 'S-1010'], true)
            ))
            ->assertSee('value="tabelas" selected', false);

        $this
            ->actingAs($user)
            ->get(route('eventos-esocial.index', ['grupo' => 'periodicos']))
            ->assertOk()
            ->assertSee('Grupo: Eventos periodicos')
            ->assertSee('folha_rpps')
            ->assertViewHas('eventos', fn ($eventos) => $eventos->getCollection()->pluck('evento')->all() === ['S-1202']);
    }

    public function test_eventos_index_links_environment_summaries_to_environment_filters(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 87,
        ]);

        EventoEsocial::create([
            'tenant_id' => 87,
            'evento' => 'S-1000',
            'status' => 'pendente',
            'ambiente' => 'homologacao',
            'payload' => ['origem' => 'parametros_orgao_publico'],
        ]);

        EventoEsocial::create([
            'tenant_id' => 87,
            'evento' => 'S-1010',
            'status' => 'processado',
            'ambiente' => 'producao',
            'payload' => ['origem' => 'rubricas'],
        ]);

        $this
            ->actingAs($user)
            ->get(route('eventos-esocial.index'))
            ->assertOk()
            ->assertSee('Homologacao')
            ->assertSee('Producao')
            ->assertSee('href="'.route('eventos-esocial.index', ['ambiente' => 'homologacao']).'"', false)
            ->assertSee('href="'.route('eventos-esocial.index', ['ambiente' => 'producao']).'"', false);

        $this
            ->actingAs($user)
            ->get(route('eventos-esocial.index', ['ambiente' => 'producao']))
            ->assertOk()
            ->assertSee('rubricas')
            ->assertViewHas('eventos', fn ($eventos) => $eventos->getCollection()->pluck('ambiente')->every(fn ($ambiente) => $ambiente === 'producao'))
            ->assertSee('value="producao" selected', false)
            ->assertSee('Ambiente: Producao');
    }

    public function test_eventos_index_can_filter_by_contexto(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 91,
        ]);

        EventoEsocial::create([
            'tenant_id' => 91,
            'evento' => 'S-1000',
            'status' => 'pendente',
            'ambiente' => 'homologacao',
            'payload' => ['origem' => 'parametros_orgao_publico'],
        ]);

        $pessoa = Pessoa::create([
            'tenant_id' => 91,
            'nome_completo' => 'Servidor Contexto',
            'cpf' => '529.982.247-25',
        ]);

        $servidor = Servidor::create([
            'tenant_id' => 91,
            'pessoa_id' => $pessoa->id,
            'matricula' => 'CTX-9101',
            'tipo_vinculo' => 'estatutario',
            'data_admissao' => '2026-04-20',
            'salario_base' => 4500,
            'situacao' => 'ativo',
        ]);

        EventoEsocial::create([
            'tenant_id' => 91,
            'servidor_id' => $servidor->id,
            'evento' => 'S-2200',
            'status' => 'pendente',
            'ambiente' => 'homologacao',
            'payload' => ['origem' => 'cadastro_inicial_servidor'],
        ]);

        $this
            ->actingAs($user)
            ->get(route('eventos-esocial.index', ['contexto' => 'institucional']))
            ->assertOk()
            ->assertSee('Evento institucional')
            ->assertViewHas('eventos', fn ($eventos) => $eventos->getCollection()->every(fn ($evento) => $evento->servidor_id === null))
            ->assertSee('Contexto: Institucional')
            ->assertSee('value="institucional" selected', false);

        $this
            ->actingAs($user)
            ->get(route('eventos-esocial.index', ['contexto' => 'vinculado']))
            ->assertOk()
            ->assertSee('Servidor Contexto')
            ->assertDontSee('Evento institucional')
            ->assertSee('Contexto: Vinculado a servidor')
            ->assertSee('value="vinculado" selected', false);
    }

    public function test_eventos_index_links_context_summaries_to_filters(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 92,
        ]);

        EventoEsocial::create([
            'tenant_id' => 92,
            'evento' => 'S-1000',
            'status' => 'pendente',
            'ambiente' => 'homologacao',
            'payload' => ['origem' => 'parametros_orgao_publico'],
        ]);

        $pessoa = Pessoa::create([
            'tenant_id' => 92,
            'nome_completo' => 'Servidor Vinculado',
            'cpf' => '111.444.777-35',
        ]);

        $servidor = Servidor::create([
            'tenant_id' => 92,
            'pessoa_id' => $pessoa->id,
            'matricula' => 'CTX-9201',
            'tipo_vinculo' => 'estatutario',
            'data_admissao' => '2026-04-20',
            'salario_base' => 4800,
            'situacao' => 'ativo',
        ]);

        EventoEsocial::create([
            'tenant_id' => 92,
            'servidor_id' => $servidor->id,
            'evento' => 'S-2200',
            'status' => 'pendente',
            'ambiente' => 'homologacao',
            'payload' => ['origem' => 'cadastro_inicial_servidor'],
        ]);

        $this
            ->actingAs($user)
            ->get(route('eventos-esocial.index'))
            ->assertOk()
            ->assertSee('Institucionais')
            ->assertSee('Vinculados')
            ->assertSee('href="'.route('eventos-esocial.index', ['contexto' => 'institucional']).'"', false)
            ->assertSee('href="'.route('eventos-esocial.index', ['contexto' => 'vinculado']).'"', false);
    }

    public function test_eventos_index_can_filter_by_servidor(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 93,
        ]);

        $pessoaA = Pessoa::create([
            'tenant_id' => 93,
            'nome_completo' => 'Aline Martins',
            'cpf' => '123.456.789-10',
        ]);

        $pessoaB = Pessoa::create([
            'tenant_id' => 93,
            'nome_completo' => 'Bruno Nogueira',
            'cpf' => '123.456.789-11',
        ]);

        $servidorA = Servidor::create([
            'tenant_id' => 93,
            'pessoa_id' => $pessoaA->id,
            'matricula' => 'MAT-9301',
            'tipo_vinculo' => 'estatutario',
            'data_admissao' => '2026-04-20',
            'salario_base' => 4100,
            'situacao' => 'ativo',
        ]);

        $servidorB = Servidor::create([
            'tenant_id' => 93,
            'pessoa_id' => $pessoaB->id,
            'matricula' => 'MAT-9302',
            'tipo_vinculo' => 'estatutario',
            'data_admissao' => '2026-04-20',
            'salario_base' => 4200,
            'situacao' => 'ativo',
        ]);

        EventoEsocial::create([
            'tenant_id' => 93,
            'servidor_id' => $servidorA->id,
            'evento' => 'S-2200',
            'status' => 'pendente',
            'ambiente' => 'homologacao',
            'payload' => ['origem' => 'cadastro_inicial_servidor'],
        ]);

        EventoEsocial::create([
            'tenant_id' => 93,
            'servidor_id' => $servidorB->id,
            'evento' => 'S-1200',
            'status' => 'erro',
            'ambiente' => 'producao',
            'payload' => ['origem' => 'folha_pagamento'],
        ]);

        $this
            ->actingAs($user)
            ->get(route('eventos-esocial.index', ['servidor' => $servidorB->id]))
            ->assertOk()
            ->assertSee('Servidor: Bruno Nogueira - MAT-9302')
            ->assertSee('folha_pagamento')
            ->assertSee('Bruno Nogueira')
            ->assertViewHas('eventos', fn ($eventos) => $eventos->getCollection()->pluck('servidor_id')->every(fn ($servidorId) => $servidorId === $servidorB->id))
            ->assertSee('value="'.$servidorB->id.'" selected', false);
    }

    public function test_eventos_index_can_filter_by_update_date(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 94,
        ]);

        $eventoMesmoDia = EventoEsocial::create([
            'tenant_id' => 94,
            'evento' => 'S-1000',
            'status' => 'pendente',
            'ambiente' => 'homologacao',
            'payload' => ['origem' => 'parametros_orgao_publico'],
        ]);

        $eventoOutroDia = EventoEsocial::create([
            'tenant_id' => 94,
            'evento' => 'S-1010',
            'status' => 'erro',
            'ambiente' => 'producao',
            'payload' => ['origem' => 'rubricas'],
        ]);

        $eventoMesmoDia->forceFill([
            'updated_at' => now()->setDate(2026, 4, 24)->setTime(9, 15),
        ])->saveQuietly();

        $eventoOutroDia->forceFill([
            'updated_at' => now()->setDate(2026, 4, 23)->setTime(18, 45),
        ])->saveQuietly();

        $this
            ->actingAs($user)
            ->get(route('eventos-esocial.index', ['data' => '2026-04-24']))
            ->assertOk()
            ->assertSee('S-1000')
            ->assertSee('Data: 24/04/2026')
            ->assertViewHas('eventos', fn ($eventos) => $eventos->getCollection()->every(
                fn ($evento) => optional($evento->updated_at)->toDateString() === '2026-04-24'
            ))
            ->assertSee('value="2026-04-24"', false);
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
            ->assertViewHas('eventos', fn ($eventos) => $eventos->getCollection()->every(fn ($evento) => filled($evento->mensagem_retorno)))
            ->assertSee('href="'.route('eventos-esocial.index', ['retorno' => 'com_mensagem']).'"', false)
            ->assertSee('value="com_mensagem" selected', false);
    }

    public function test_eventos_index_can_filter_events_without_return_message(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 88,
        ]);

        EventoEsocial::create([
            'tenant_id' => 88,
            'evento' => 'S-1000',
            'status' => 'processado',
            'ambiente' => 'homologacao',
            'mensagem_retorno' => 'Evento recebido com sucesso.',
            'payload' => ['origem' => 'parametros_orgao_publico'],
        ]);

        EventoEsocial::create([
            'tenant_id' => 88,
            'evento' => 'S-1010',
            'status' => 'pendente',
            'ambiente' => 'homologacao',
            'mensagem_retorno' => null,
            'payload' => ['origem' => 'rubricas'],
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('eventos-esocial.index', ['retorno' => 'sem_mensagem']));

        $response
            ->assertOk()
            ->assertSee('rubricas')
            ->assertViewHas('eventos', fn ($eventos) => $eventos->getCollection()->every(fn ($evento) => blank($evento->mensagem_retorno)))
            ->assertSee('Retorno: Sem mensagem')
            ->assertSee('value="sem_mensagem" selected', false);
    }

    public function test_eventos_index_links_without_return_summary_to_filter(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 89,
        ]);

        EventoEsocial::create([
            'tenant_id' => 89,
            'evento' => 'S-1010',
            'status' => 'pendente',
            'ambiente' => 'homologacao',
            'mensagem_retorno' => null,
            'payload' => ['origem' => 'rubricas'],
        ]);

        $this
            ->actingAs($user)
            ->get(route('eventos-esocial.index'))
            ->assertOk()
            ->assertSee('Sem retorno')
            ->assertSee('Aguardando mensagem registrada')
            ->assertSee('href="'.route('eventos-esocial.index', ['retorno' => 'sem_mensagem']).'"', false);
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
                'origem' => 'parametros_orgao_publico',
                'retorno' => 'com_mensagem',
            ]))
            ->assertOk()
            ->assertSee('Filtros ativos')
            ->assertSee('Busca: S-1000')
            ->assertSee('Evento: S-1000')
            ->assertSee('Status: Erro')
            ->assertSee('Ambiente: Homologacao')
            ->assertSee('Origem: parametros_orgao_publico')
            ->assertSee('Retorno: Com mensagem')
            ->assertSee('href="'.route('eventos-esocial.index').'"', false);
    }

    public function test_eventos_index_can_filter_by_payload_origin(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 90,
        ]);

        EventoEsocial::create([
            'tenant_id' => 90,
            'evento' => 'S-1000',
            'status' => 'pendente',
            'ambiente' => 'homologacao',
            'payload' => ['origem' => 'parametros_orgao_publico'],
        ]);

        EventoEsocial::create([
            'tenant_id' => 90,
            'evento' => 'S-2200',
            'status' => 'pendente',
            'ambiente' => 'homologacao',
            'payload' => ['origem' => 'cadastro_inicial_servidor'],
        ]);

        $this
            ->actingAs($user)
            ->get(route('eventos-esocial.index', ['origem' => 'parametros_orgao_publico']))
            ->assertOk()
            ->assertSee('parametros_orgao_publico')
            ->assertViewHas('eventos', fn ($eventos) => $eventos->getCollection()->pluck('payload.origem')->unique()->values()->all() === ['parametros_orgao_publico'])
            ->assertSee('Origem: parametros_orgao_publico')
            ->assertSee('value="parametros_orgao_publico" selected', false);
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
