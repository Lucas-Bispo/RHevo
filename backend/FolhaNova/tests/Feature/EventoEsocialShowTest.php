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
            ->assertSee('Lucas Ribeiro');
    }
}
