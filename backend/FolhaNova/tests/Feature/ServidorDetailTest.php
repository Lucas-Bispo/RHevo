<?php

namespace Tests\Feature;

use App\Models\EventoEsocial;
use App\Models\Pessoa;
use App\Models\Servidor;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServidorDetailTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_open_servidor_detail_screen(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 12,
        ]);

        $pessoa = Pessoa::create([
            'tenant_id' => 12,
            'nome_completo' => 'Helena Martins',
            'cpf' => '123.456.789-99',
        ]);

        $servidor = Servidor::create([
            'tenant_id' => 12,
            'pessoa_id' => $pessoa->id,
            'matricula' => 'HE-001',
            'tipo_vinculo' => 'estatutario',
            'situacao' => 'ativo',
            'salario_base' => 5500,
            'data_admissao' => '2026-03-10',
        ]);

        $evento = EventoEsocial::create([
            'tenant_id' => 12,
            'servidor_id' => $servidor->id,
            'evento' => 'S-2200',
            'status' => 'pendente',
            'ambiente' => 'homologacao',
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('servidores.show', $servidor));

        $response
            ->assertOk()
            ->assertSee('Helena Martins')
            ->assertSee('HE-001')
            ->assertSee('S-2200')
            ->assertSee('Detalhar evento')
            ->assertSee('href="'.route('eventos-esocial.show', $evento).'"', false);
    }

    public function test_user_can_update_servidor_and_pending_event_payload(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 14,
        ]);

        $pessoa = Pessoa::create([
            'tenant_id' => 14,
            'nome_completo' => 'Lucas Ribeiro',
            'cpf' => '111.222.333-44',
            'email' => 'antigo@prefeitura.gov.br',
        ]);

        $servidor = Servidor::create([
            'tenant_id' => 14,
            'pessoa_id' => $pessoa->id,
            'matricula' => 'LR-100',
            'tipo_vinculo' => 'estatutario',
            'categoria_esocial' => '301',
            'situacao' => 'ativo',
            'salario_base' => 4800,
            'data_admissao' => '2026-02-01',
        ]);

        $evento = EventoEsocial::create([
            'tenant_id' => 14,
            'servidor_id' => $servidor->id,
            'evento' => 'S-2200',
            'status' => 'pendente',
            'ambiente' => 'homologacao',
            'payload' => [
                'trabalhador' => ['nome_completo' => 'Lucas Ribeiro'],
                'vinculo' => ['matricula' => 'LR-100'],
            ],
        ]);

        $response = $this
            ->actingAs($user)
            ->put(route('servidores.update', $servidor), [
                'nome_completo' => 'Lucas Ribeiro Silva',
                'cpf' => '11122233344',
                'email' => 'lucas.silva@prefeitura.gov.br',
                'matricula' => 'LR-100',
                'tipo_vinculo' => 'estatutario',
                'categoria_esocial' => '302',
                'regime_previdenciario' => 'rpps',
                'data_admissao' => '2026-02-01',
                'salario_base' => '5120.00',
                'situacao' => 'afastado',
            ]);

        $response
            ->assertRedirect(route('servidores.show', $servidor))
            ->assertSessionHas('status');

        $this->assertDatabaseHas('pessoas', [
            'id' => $pessoa->id,
            'nome_completo' => 'Lucas Ribeiro Silva',
            'cpf' => '111.222.333-44',
            'email' => 'lucas.silva@prefeitura.gov.br',
        ]);

        $this->assertDatabaseHas('servidores', [
            'id' => $servidor->id,
            'categoria_esocial' => '302',
            'situacao' => 'afastado',
            'salario_base' => 5120,
        ]);

        $evento->refresh();

        $this->assertSame('Lucas Ribeiro Silva', $evento->payload['trabalhador']['nome_completo']);
        $this->assertSame('302', $evento->payload['vinculo']['categoria_esocial']);
        $this->assertSame('afastado', $evento->payload['vinculo']['situacao']);
    }
}
