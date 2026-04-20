<?php

namespace Tests\Feature;

use App\Models\Rubrica;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RubricasIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_open_rubricas_index(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 63,
        ]);

        Rubrica::create([
            'tenant_id' => 63,
            'codigo' => 'RUB-101',
            'nome' => 'Adicional noturno',
            'natureza' => 'Adicional',
            'tipo' => 'provento',
            'incide_irrf' => true,
            'incide_inss' => true,
            'incide_fgts' => true,
            'codigo_esocial' => 'S1010-NOT',
            'ativo' => true,
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('rubricas.index'));

        $response
            ->assertOk()
            ->assertSee('Rubricas')
            ->assertSee('Adicional noturno')
            ->assertSee('S1010-NOT');
    }
}
