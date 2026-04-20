<?php

namespace Tests\Feature;

use App\Models\Rubrica;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RubricaCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_open_rubrica_creation_screen(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 60,
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('rubricas.create'));

        $response
            ->assertOk()
            ->assertSee('Cadastro de rubrica');
    }

    public function test_user_can_create_rubrica(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 61,
        ]);

        $response = $this
            ->actingAs($user)
            ->post(route('rubricas.store'), [
                'codigo' => 'RUB-001',
                'nome' => 'Gratificacao de funcao',
                'natureza' => 'Vencimento',
                'tipo' => 'provento',
                'incide_irrf' => '1',
                'incide_inss' => '1',
                'incide_fgts' => '0',
                'codigo_esocial' => 'S1010-GRAT',
                'ativo' => '1',
            ]);

        $response
            ->assertRedirect(route('rubricas.index'))
            ->assertSessionHas('status');

        $this->assertDatabaseHas('rubricas', [
            'tenant_id' => 61,
            'codigo' => 'RUB-001',
            'nome' => 'Gratificacao de funcao',
            'tipo' => 'provento',
            'incide_irrf' => true,
            'incide_inss' => true,
            'incide_fgts' => false,
            'ativo' => true,
        ]);
    }

    public function test_user_can_update_rubrica(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 62,
        ]);

        $rubrica = Rubrica::create([
            'tenant_id' => 62,
            'codigo' => 'DESC-01',
            'nome' => 'Desconto assistencial',
            'natureza' => 'Desconto',
            'tipo' => 'desconto',
            'incide_irrf' => false,
            'incide_inss' => false,
            'incide_fgts' => false,
            'ativo' => true,
        ]);

        $response = $this
            ->actingAs($user)
            ->put(route('rubricas.update', $rubrica), [
                'codigo' => 'DESC-01',
                'nome' => 'Desconto sindical',
                'natureza' => 'Desconto legal',
                'tipo' => 'desconto',
                'incide_irrf' => '0',
                'incide_inss' => '0',
                'incide_fgts' => '0',
                'codigo_esocial' => 'S1010-DESC',
                'ativo' => '0',
            ]);

        $response
            ->assertRedirect(route('rubricas.index'))
            ->assertSessionHas('status');

        $this->assertDatabaseHas('rubricas', [
            'id' => $rubrica->id,
            'nome' => 'Desconto sindical',
            'natureza' => 'Desconto legal',
            'codigo_esocial' => 'S1010-DESC',
            'ativo' => false,
        ]);
    }
}
