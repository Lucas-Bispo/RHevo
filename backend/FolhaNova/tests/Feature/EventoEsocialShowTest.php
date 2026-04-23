<?php

namespace Tests\Feature;

use App\Models\EventoEsocial;
use App\Models\Pessoa;
use App\Models\Servidor;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventoEsocialShowTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_open_evento_esocial_detail(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 73,
        ]);

        $pessoa = Pessoa::create([
            'tenant_id' => 73,
            'nome_completo' => 'Lucas Ribeiro',
            'cpf' => '987.654.321-00',
        ]);

        $servidor = Servidor::create([
            'tenant_id' => 73,
            'pessoa_id' => $pessoa->id,
            'matricula' => 'MAT-7301',
            'tipo_vinculo' => 'estatutario',
            'data_admissao' => '2026-04-20',
            'salario_base' => 3900,
            'situacao' => 'ativo',
        ]);

        $evento = EventoEsocial::create([
            'tenant_id' => 73,
            'servidor_id' => $servidor->id,
            'evento' => 'S-2200',
            'status' => 'processado',
            'ambiente' => 'producao',
            'protocolo' => 'PROC-7301',
            'recibo' => 'REC-7301',
            'mensagem_retorno' => 'Evento recebido com sucesso.',
            'payload' => [
                'origem' => 'cadastro_inicial_servidor',
                'trabalhador' => [
                    'nome_completo' => 'Lucas Ribeiro',
                ],
            ],
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('eventos-esocial.show', $evento));

        $response
            ->assertOk()
            ->assertSee('Detalhe do evento eSocial')
            ->assertSee('PROC-7301')
            ->assertSee('Evento recebido com sucesso.')
            ->assertSee('Lucas Ribeiro')
            ->assertSee('href="'.route('eventos-esocial.index', ['evento' => 'S-2200']).'"', false)
            ->assertSee('href="'.route('eventos-esocial.index', ['status' => 'processado']).'"', false)
            ->assertSee('href="'.route('eventos-esocial.index', ['ambiente' => 'producao']).'"', false)
            ->assertSee('href="'.route('eventos-esocial.index', ['origem' => 'cadastro_inicial_servidor']).'"', false)
            ->assertSee('href="'.route('eventos-esocial.index', ['retorno' => 'com_mensagem']).'"', false)
            ->assertSee('Com retorno')
            ->assertSee('Mesmo ambiente')
            ->assertSee('Mesma origem')
            ->assertSee('Abrir servidor')
            ->assertSee('href="'.route('servidores.show', $servidor).'"', false);
    }

    public function test_user_can_requeue_failed_event_for_local_reprocessing(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 74,
        ]);

        $evento = EventoEsocial::create([
            'tenant_id' => 74,
            'evento' => 'S-1000',
            'status' => 'erro',
            'ambiente' => 'homologacao',
            'protocolo' => 'PROTO-ERRO',
            'recibo' => 'REC-ERRO',
            'mensagem_retorno' => 'Rubrica rejeitada pela validacao local.',
            'enviado_em' => now()->subMinutes(15),
            'processado_em' => now()->subMinutes(10),
            'payload' => ['origem' => 'parametros_orgao_publico'],
        ]);

        $response = $this
            ->actingAs($user)
            ->post(route('eventos-esocial.reprocessar', $evento));

        $response
            ->assertRedirect(route('eventos-esocial.show', $evento))
            ->assertSessionHas('status', 'Evento reenfileirado como pendente para reprocessamento local.');

        $this->assertDatabaseHas('eventos_esocial', [
            'id' => $evento->id,
            'tenant_id' => 74,
            'evento' => 'S-1000',
            'status' => 'pendente',
            'protocolo' => null,
            'recibo' => null,
            'mensagem_retorno' => null,
            'enviado_em' => null,
            'processado_em' => null,
        ]);
    }

    public function test_failed_event_detail_explains_local_reprocessing_action(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 80,
        ]);

        $evento = EventoEsocial::create([
            'tenant_id' => 80,
            'evento' => 'S-1010',
            'status' => 'erro',
            'ambiente' => 'homologacao',
            'mensagem_retorno' => 'Falha de validacao local.',
            'payload' => ['origem' => 'rubricas'],
        ]);

        $this
            ->actingAs($user)
            ->get(route('eventos-esocial.show', $evento))
            ->assertOk()
            ->assertSee('Evento com erro pode ser reenfileirado para reprocessamento local.')
            ->assertSee('Com retorno')
            ->assertSee('href="'.route('eventos-esocial.index', ['retorno' => 'com_mensagem']).'"', false)
            ->assertSee('Reprocessar');
    }

    public function test_event_detail_links_without_return_when_message_is_missing(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 81,
        ]);

        $evento = EventoEsocial::create([
            'tenant_id' => 81,
            'evento' => 'S-1000',
            'status' => 'pendente',
            'ambiente' => 'homologacao',
            'mensagem_retorno' => null,
            'payload' => ['origem' => 'parametros_orgao_publico'],
        ]);

        $this
            ->actingAs($user)
            ->get(route('eventos-esocial.show', $evento))
            ->assertOk()
            ->assertSee('Sem retorno')
            ->assertSee('href="'.route('eventos-esocial.index', ['retorno' => 'sem_mensagem']).'"', false);
    }

    public function test_user_cannot_requeue_processed_event(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 75,
        ]);

        $evento = EventoEsocial::create([
            'tenant_id' => 75,
            'evento' => 'S-2200',
            'status' => 'processado',
            'ambiente' => 'producao',
            'protocolo' => 'PROTO-OK',
            'recibo' => 'REC-OK',
            'mensagem_retorno' => 'Evento recebido.',
            'payload' => ['origem' => 'cadastro_inicial_servidor'],
        ]);

        $response = $this
            ->actingAs($user)
            ->post(route('eventos-esocial.reprocessar', $evento));

        $response
            ->assertRedirect(route('eventos-esocial.show', $evento))
            ->assertSessionHas('warning', 'Apenas eventos com erro podem ser reenfileirados nesta etapa.');

        $this->assertDatabaseHas('eventos_esocial', [
            'id' => $evento->id,
            'status' => 'processado',
            'protocolo' => 'PROTO-OK',
            'recibo' => 'REC-OK',
            'mensagem_retorno' => 'Evento recebido.',
        ]);
    }

    public function test_user_cannot_requeue_event_from_another_tenant(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 76,
        ]);

        $evento = EventoEsocial::create([
            'tenant_id' => 77,
            'evento' => 'S-1010',
            'status' => 'erro',
            'ambiente' => 'homologacao',
            'payload' => ['origem' => 'rubricas'],
        ]);

        $this
            ->actingAs($user)
            ->post(route('eventos-esocial.reprocessar', $evento))
            ->assertNotFound();
    }
}
