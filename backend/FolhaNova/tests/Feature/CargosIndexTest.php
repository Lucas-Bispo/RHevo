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
            ->assertSee('S1030-ENG')
            ->assertSee('Prontos S-1030')
            ->assertSee('Pendencias S-1030')
            ->assertSee('Base para S-1030');
    }

    public function test_cargos_index_filters_by_esocial_readiness(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 44,
        ]);

        Cargo::create([
            'tenant_id' => 44,
            'codigo' => 'ANL',
            'nome' => 'Analista Administrativo',
            'codigo_esocial' => 'S1030-ANL',
            'ativo' => true,
        ]);

        Cargo::create([
            'tenant_id' => 44,
            'codigo' => 'AUX',
            'nome' => 'Auxiliar sem Parametrizacao',
            'codigo_esocial' => null,
            'ativo' => true,
        ]);

        Cargo::create([
            'tenant_id' => 44,
            'codigo' => 'EXT',
            'nome' => 'Cargo em Extincao',
            'codigo_esocial' => 'S1030-EXT',
            'ativo' => false,
        ]);

        $readyResponse = $this
            ->actingAs($user)
            ->get(route('cargos.index', ['prontidao' => 'pronto']));

        $readyResponse
            ->assertOk()
            ->assertSee('Analista Administrativo')
            ->assertDontSee('Auxiliar sem Parametrizacao')
            ->assertDontSee('Cargo em Extincao')
            ->assertSee('Prontidao S-1030: Pronto');

        $pendingResponse = $this
            ->actingAs($user)
            ->get(route('cargos.index', ['prontidao' => 'pendente']));

        $pendingResponse
            ->assertOk()
            ->assertSee('Auxiliar sem Parametrizacao')
            ->assertSee('Cargo em Extincao')
            ->assertDontSee('Analista Administrativo')
            ->assertSee('Prontidao S-1030: Com pendencias');
    }
}
