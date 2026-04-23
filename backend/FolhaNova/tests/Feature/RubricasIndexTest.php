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
            'natureza' => '1002',
            'tipo' => 'provento',
            'incide_irrf' => true,
            'incide_inss' => true,
            'incide_fgts' => true,
            'codigo_esocial' => 'S1010-NOT',
            'inicio_validade' => '2026-01-01',
            'fim_validade' => '2026-12-31',
            'ativo' => true,
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('rubricas.index'));

        $response
            ->assertOk()
            ->assertSee('Rubricas')
            ->assertSee('Adicional noturno')
            ->assertSee('Natureza eSocial 1002')
            ->assertSee('Vigencia:')
            ->assertSee('01/01/2026')
            ->assertSee('ate 31/12/2026')
            ->assertSee('S1010-NOT')
            ->assertSee('Ver S-1010 no painel')
            ->assertSee('href="'.route('eventos-esocial.index', ['evento' => 'S-1010']).'"', false);
    }

    public function test_authenticated_user_can_filter_rubricas_by_tipo(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 64,
        ]);

        Rubrica::create([
            'tenant_id' => 64,
            'codigo' => 'PROV-001',
            'nome' => 'Adicional noturno',
            'natureza' => '1002',
            'tipo' => 'provento',
            'incide_irrf' => true,
            'incide_inss' => true,
            'incide_fgts' => true,
            'ativo' => true,
        ]);

        Rubrica::create([
            'tenant_id' => 64,
            'codigo' => 'DESC-001',
            'nome' => 'Desconto sindical',
            'natureza' => '9219',
            'tipo' => 'desconto',
            'incide_irrf' => false,
            'incide_inss' => false,
            'incide_fgts' => false,
            'ativo' => true,
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('rubricas.index', ['tipo' => 'desconto']));

        $response
            ->assertOk()
            ->assertSee('Desconto sindical')
            ->assertDontSee('Adicional noturno')
            ->assertSee('value="desconto" selected', false);
    }

    public function test_authenticated_user_can_filter_rubricas_by_incidencia(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 65,
        ]);

        Rubrica::create([
            'tenant_id' => 65,
            'codigo' => 'IRRF-001',
            'nome' => 'Gratificacao tributavel',
            'natureza' => '1002',
            'tipo' => 'provento',
            'incide_irrf' => true,
            'incide_inss' => false,
            'incide_fgts' => false,
            'ativo' => true,
        ]);

        Rubrica::create([
            'tenant_id' => 65,
            'codigo' => 'SEM-IRRF',
            'nome' => 'Ajuda indenizatoria',
            'natureza' => '1409',
            'tipo' => 'informativa',
            'incide_irrf' => false,
            'incide_inss' => false,
            'incide_fgts' => false,
            'ativo' => true,
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('rubricas.index', ['incidencia' => 'irrf']));

        $response
            ->assertOk()
            ->assertSee('Gratificacao tributavel')
            ->assertDontSee('Ajuda indenizatoria')
            ->assertSee('value="irrf" selected', false);
    }

    public function test_authenticated_user_can_filter_rubricas_with_codigo_esocial(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 66,
        ]);

        Rubrica::create([
            'tenant_id' => 66,
            'codigo' => 'S1010-001',
            'nome' => 'Vencimento base parametrizado',
            'natureza' => '1000',
            'tipo' => 'provento',
            'incide_irrf' => true,
            'incide_inss' => true,
            'incide_fgts' => true,
            'codigo_esocial' => 'S1010-VENC',
            'ativo' => true,
        ]);

        Rubrica::create([
            'tenant_id' => 66,
            'codigo' => 'SEM-COD',
            'nome' => 'Rubrica em parametrizacao',
            'natureza' => '1002',
            'tipo' => 'provento',
            'incide_irrf' => true,
            'incide_inss' => true,
            'incide_fgts' => false,
            'codigo_esocial' => null,
            'ativo' => true,
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('rubricas.index', ['esocial' => 'com_codigo']));

        $response
            ->assertOk()
            ->assertSee('Vencimento base parametrizado')
            ->assertDontSee('Rubrica em parametrizacao')
            ->assertSee('href="'.route('rubricas.index', ['esocial' => 'com_codigo']).'"', false)
            ->assertSee('value="com_codigo" selected', false);
    }

    public function test_authenticated_user_can_filter_rubricas_without_codigo_esocial(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 67,
        ]);

        Rubrica::create([
            'tenant_id' => 67,
            'codigo' => 'S1010-002',
            'nome' => 'Vencimento base parametrizado',
            'natureza' => '1000',
            'tipo' => 'provento',
            'incide_irrf' => true,
            'incide_inss' => true,
            'incide_fgts' => true,
            'codigo_esocial' => 'S1010-VENC',
            'ativo' => true,
        ]);

        Rubrica::create([
            'tenant_id' => 67,
            'codigo' => 'SEM-COD-002',
            'nome' => 'Rubrica pendente de parametrizacao',
            'natureza' => '1002',
            'tipo' => 'provento',
            'incide_irrf' => true,
            'incide_inss' => true,
            'incide_fgts' => false,
            'codigo_esocial' => null,
            'ativo' => true,
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('rubricas.index', ['esocial' => 'sem_codigo']));

        $response
            ->assertOk()
            ->assertSee('Rubrica pendente de parametrizacao')
            ->assertDontSee('Vencimento base parametrizado')
            ->assertSee('Sem codigo eSocial')
            ->assertSee('href="'.route('rubricas.index', ['esocial' => 'sem_codigo']).'"', false)
            ->assertSee('value="sem_codigo" selected', false);
    }
}
