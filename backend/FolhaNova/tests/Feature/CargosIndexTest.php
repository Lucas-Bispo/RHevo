<?php

namespace Tests\Feature;

use App\Models\Cargo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CargosIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_open_cargos_index(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 43,
        ]);

        Cargo::create([
            'tenant_id' => 43,
            'codigo' => 'ENG-01',
            'nome' => 'Engenheiro Civil',
            'codigo_esocial' => 'S1030-ENG',
            'ativo' => true,
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('cargos.index'));

        $response
            ->assertOk()
            ->assertSee('Cargos')
            ->assertSee('Engenheiro Civil')
            ->assertSee('S1030-ENG');
    }
}
