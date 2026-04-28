<?php

namespace Tests\Feature;

use App\Models\Rubrica;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
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

    public function test_rubricas_index_links_status_summaries_to_status_filters(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 69,
        ]);

        Rubrica::create([
            'tenant_id' => 69,
            'codigo' => 'ATIVA-001',
            'nome' => 'Rubrica ativa',
            'natureza' => '1000',
            'tipo' => 'provento',
            'incide_irrf' => true,
            'incide_inss' => true,
            'incide_fgts' => false,
            'ativo' => true,
        ]);

        Rubrica::create([
            'tenant_id' => 69,
            'codigo' => 'INAT-001',
            'nome' => 'Rubrica inativa',
            'natureza' => '9201',
            'tipo' => 'desconto',
            'incide_irrf' => false,
            'incide_inss' => false,
            'incide_fgts' => false,
            'ativo' => false,
        ]);

        $this
            ->actingAs($user)
            ->get(route('rubricas.index'))
            ->assertOk()
            ->assertSee('href="'.route('rubricas.index', ['status' => 'ativos']).'"', false)
            ->assertSee('href="'.route('rubricas.index', ['status' => 'inativos']).'"', false);

        $this
            ->actingAs($user)
            ->get(route('rubricas.index', ['status' => 'inativos']))
            ->assertOk()
            ->assertSee('Rubrica inativa')
            ->assertDontSee('Rubrica ativa')
            ->assertSee('value="inativos" selected', false);
    }

    public function test_rubricas_index_links_type_summaries_to_type_filters(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 70,
        ]);

        Rubrica::create([
            'tenant_id' => 70,
            'codigo' => 'PROV-001',
            'nome' => 'Vencimento base',
            'natureza' => '1000',
            'tipo' => 'provento',
            'incide_irrf' => true,
            'incide_inss' => true,
            'incide_fgts' => true,
            'ativo' => true,
        ]);

        Rubrica::create([
            'tenant_id' => 70,
            'codigo' => 'DESC-001',
            'nome' => 'Desconto consignado',
            'natureza' => '9201',
            'tipo' => 'desconto',
            'incide_irrf' => false,
            'incide_inss' => false,
            'incide_fgts' => false,
            'ativo' => true,
        ]);

        Rubrica::create([
            'tenant_id' => 70,
            'codigo' => 'INFO-001',
            'nome' => 'Base informativa',
            'natureza' => '1409',
            'tipo' => 'informativa',
            'incide_irrf' => false,
            'incide_inss' => false,
            'incide_fgts' => false,
            'ativo' => true,
        ]);

        $this
            ->actingAs($user)
            ->get(route('rubricas.index'))
            ->assertOk()
            ->assertSee('href="'.route('rubricas.index', ['tipo' => 'provento']).'"', false)
            ->assertSee('href="'.route('rubricas.index', ['tipo' => 'desconto']).'"', false)
            ->assertSee('href="'.route('rubricas.index', ['tipo' => 'informativa']).'"', false);

        $this
            ->actingAs($user)
            ->get(route('rubricas.index', ['tipo' => 'informativa']))
            ->assertOk()
            ->assertSee('Base informativa')
            ->assertDontSee('Vencimento base')
            ->assertDontSee('Desconto consignado')
            ->assertSee('value="informativa" selected', false);
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

    public function test_authenticated_user_can_filter_rubricas_by_natureza(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 98,
        ]);

        Rubrica::create([
            'tenant_id' => 98,
            'codigo' => 'NAT-1000',
            'nome' => 'Vencimento basico',
            'natureza' => '1000',
            'tipo' => 'provento',
            'incide_irrf' => true,
            'incide_inss' => true,
            'incide_fgts' => true,
            'ativo' => true,
        ]);

        Rubrica::create([
            'tenant_id' => 98,
            'codigo' => 'NAT-9201',
            'nome' => 'Desconto consignado',
            'natureza' => '9201',
            'tipo' => 'desconto',
            'incide_irrf' => false,
            'incide_inss' => false,
            'incide_fgts' => false,
            'ativo' => true,
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('rubricas.index', ['natureza' => '9201']));

        $response
            ->assertOk()
            ->assertSee('Desconto consignado')
            ->assertDontSee('Vencimento basico')
            ->assertSee('value="9201"', false)
            ->assertSee('Natureza: 9201');
    }

    public function test_rubricas_index_can_filter_by_s1010_readiness(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 99,
        ]);

        Rubrica::create([
            'tenant_id' => 99,
            'codigo' => 'S1010-OK',
            'nome' => 'Rubrica pronta S1010',
            'natureza' => '1000',
            'tipo' => 'provento',
            'incide_irrf' => true,
            'incide_inss' => true,
            'incide_fgts' => false,
            'codigo_esocial' => 'RUB-OK',
            'inicio_validade' => Carbon::today()->subMonth()->toDateString(),
            'fim_validade' => null,
            'ativo' => true,
        ]);

        Rubrica::create([
            'tenant_id' => 99,
            'codigo' => 'S1010-PEND',
            'nome' => 'Rubrica pendente S1010',
            'natureza' => '9201',
            'tipo' => 'desconto',
            'incide_irrf' => false,
            'incide_inss' => false,
            'incide_fgts' => false,
            'codigo_esocial' => null,
            'inicio_validade' => Carbon::today()->subMonth()->toDateString(),
            'fim_validade' => null,
            'ativo' => true,
        ]);

        $this
            ->actingAs($user)
            ->get(route('rubricas.index'))
            ->assertOk()
            ->assertSee('Prontas S-1010')
            ->assertSee('Pendencias S-1010')
            ->assertSee('href="'.route('rubricas.index', ['prontidao' => 'pronta']).'"', false)
            ->assertSee('href="'.route('rubricas.index', ['prontidao' => 'pendente']).'"', false);

        $this
            ->actingAs($user)
            ->get(route('rubricas.index', ['prontidao' => 'pronta']))
            ->assertOk()
            ->assertSee('Rubrica pronta S1010')
            ->assertDontSee('Rubrica pendente S1010')
            ->assertSee('Prontidao S-1010: Pronta')
            ->assertSee('value="pronta" selected', false)
            ->assertViewHas('rubricas', fn ($rubricas) => $rubricas->getCollection()->every(
                fn ($rubrica) => $rubrica->ativo
                    && filled($rubrica->codigo_esocial)
                    && $rubrica->inicio_validade?->lte(Carbon::today())
                    && ($rubrica->fim_validade === null || $rubrica->fim_validade->gte(Carbon::today()))
            ));

        $this
            ->actingAs($user)
            ->get(route('rubricas.index', ['prontidao' => 'pendente']))
            ->assertOk()
            ->assertSee('Rubrica pendente S1010')
            ->assertDontSee('Rubrica pronta S1010')
            ->assertSee('Prontidao S-1010: Com pendencias')
            ->assertSee('value="pendente" selected', false);
    }

    public function test_rubricas_index_links_incidencia_summaries_to_filters(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 71,
        ]);

        Rubrica::create([
            'tenant_id' => 71,
            'codigo' => 'IRRF-001',
            'nome' => 'Verba tributavel',
            'natureza' => '1002',
            'tipo' => 'provento',
            'incide_irrf' => true,
            'incide_inss' => false,
            'incide_fgts' => false,
            'ativo' => true,
        ]);

        Rubrica::create([
            'tenant_id' => 71,
            'codigo' => 'INSS-001',
            'nome' => 'Verba previdenciaria',
            'natureza' => '1000',
            'tipo' => 'provento',
            'incide_irrf' => false,
            'incide_inss' => true,
            'incide_fgts' => false,
            'ativo' => true,
        ]);

        Rubrica::create([
            'tenant_id' => 71,
            'codigo' => 'FGTS-001',
            'nome' => 'Verba fundiaria',
            'natureza' => '1000',
            'tipo' => 'provento',
            'incide_irrf' => false,
            'incide_inss' => false,
            'incide_fgts' => true,
            'ativo' => true,
        ]);

        $this
            ->actingAs($user)
            ->get(route('rubricas.index'))
            ->assertOk()
            ->assertSee('href="'.route('rubricas.index', ['incidencia' => 'irrf']).'"', false)
            ->assertSee('href="'.route('rubricas.index', ['incidencia' => 'inss']).'"', false)
            ->assertSee('href="'.route('rubricas.index', ['incidencia' => 'fgts']).'"', false);

        $this
            ->actingAs($user)
            ->get(route('rubricas.index', ['incidencia' => 'fgts']))
            ->assertOk()
            ->assertSee('Verba fundiaria')
            ->assertDontSee('Verba tributavel')
            ->assertDontSee('Verba previdenciaria')
            ->assertSee('value="fgts" selected', false);
    }

    public function test_authenticated_user_can_filter_rubricas_by_vigencia(): void
    {
        Carbon::setTestNow('2026-04-24 10:00:00');

        $user = User::factory()->create([
            'tenant_id' => 72,
        ]);

        Rubrica::create([
            'tenant_id' => 72,
            'codigo' => 'VIG-ATIVA',
            'nome' => 'Rubrica vigente',
            'natureza' => '1000',
            'tipo' => 'provento',
            'incide_irrf' => true,
            'incide_inss' => true,
            'incide_fgts' => false,
            'inicio_validade' => '2026-01-01',
            'fim_validade' => null,
            'ativo' => true,
        ]);

        Rubrica::create([
            'tenant_id' => 72,
            'codigo' => 'VIG-FUTURA',
            'nome' => 'Rubrica futura',
            'natureza' => '1002',
            'tipo' => 'provento',
            'incide_irrf' => true,
            'incide_inss' => false,
            'incide_fgts' => false,
            'inicio_validade' => '2026-05-01',
            'fim_validade' => null,
            'ativo' => false,
        ]);

        Rubrica::create([
            'tenant_id' => 72,
            'codigo' => 'VIG-ENC',
            'nome' => 'Rubrica encerrada',
            'natureza' => '9201',
            'tipo' => 'desconto',
            'incide_irrf' => false,
            'incide_inss' => false,
            'incide_fgts' => false,
            'inicio_validade' => '2025-01-01',
            'fim_validade' => '2026-03-31',
            'ativo' => false,
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('rubricas.index', ['vigencia' => 'futura']));

        $response
            ->assertOk()
            ->assertSee('Rubrica futura')
            ->assertDontSee('Rubrica vigente')
            ->assertDontSee('Rubrica encerrada')
            ->assertSee('value="futura" selected', false)
            ->assertSee('Vigencia: Futura');

        Carbon::setTestNow();
    }

    public function test_rubricas_index_links_vigencia_summaries_to_filters(): void
    {
        Carbon::setTestNow('2026-04-24 10:00:00');

        $user = User::factory()->create([
            'tenant_id' => 73,
        ]);

        Rubrica::create([
            'tenant_id' => 73,
            'codigo' => 'ATIVA-001',
            'nome' => 'Rubrica atual',
            'natureza' => '1000',
            'tipo' => 'provento',
            'incide_irrf' => true,
            'incide_inss' => true,
            'incide_fgts' => true,
            'inicio_validade' => '2026-01-01',
            'fim_validade' => null,
            'ativo' => true,
        ]);

        Rubrica::create([
            'tenant_id' => 73,
            'codigo' => 'FUT-001',
            'nome' => 'Rubrica programada',
            'natureza' => '1002',
            'tipo' => 'provento',
            'incide_irrf' => true,
            'incide_inss' => false,
            'incide_fgts' => false,
            'inicio_validade' => '2026-05-10',
            'fim_validade' => null,
            'ativo' => false,
        ]);

        Rubrica::create([
            'tenant_id' => 73,
            'codigo' => 'ENC-001',
            'nome' => 'Rubrica historica',
            'natureza' => '9201',
            'tipo' => 'desconto',
            'incide_irrf' => false,
            'incide_inss' => false,
            'incide_fgts' => false,
            'inicio_validade' => '2025-01-01',
            'fim_validade' => '2026-03-20',
            'ativo' => false,
        ]);

        $this
            ->actingAs($user)
            ->get(route('rubricas.index'))
            ->assertOk()
            ->assertSee('href="'.route('rubricas.index', ['vigencia' => 'ativa']).'"', false)
            ->assertSee('href="'.route('rubricas.index', ['vigencia' => 'futura']).'"', false)
            ->assertSee('href="'.route('rubricas.index', ['vigencia' => 'encerrada']).'"', false)
            ->assertSee('Vigencia ativa')
            ->assertSee('Vigencia futura')
            ->assertSee('Vigencia encerrada');

        $this
            ->actingAs($user)
            ->get(route('rubricas.index', ['vigencia' => 'encerrada']))
            ->assertOk()
            ->assertSee('Rubrica historica')
            ->assertDontSee('Rubrica atual')
            ->assertDontSee('Rubrica programada')
            ->assertSee('value="encerrada" selected', false);

        Carbon::setTestNow();
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

    public function test_rubricas_index_shows_active_filters_summary(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 68,
        ]);

        Rubrica::create([
            'tenant_id' => 68,
            'codigo' => 'IRRF-SEM-COD',
            'nome' => 'Gratificacao sem codigo',
            'natureza' => '1002',
            'tipo' => 'provento',
            'incide_irrf' => true,
            'incide_inss' => false,
            'incide_fgts' => false,
            'codigo_esocial' => null,
            'ativo' => true,
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('rubricas.index', [
                'q' => 'Gratificacao',
                'status' => 'ativos',
                'tipo' => 'provento',
                'natureza' => '1002',
                'incidencia' => 'irrf',
                'esocial' => 'sem_codigo',
                'vigencia' => 'ativa',
            ]));

        $response
            ->assertOk()
            ->assertSee('Filtros ativos')
            ->assertSee('Busca: Gratificacao')
            ->assertSee('Status: Ativas')
            ->assertSee('Tipo: Provento')
            ->assertSee('Natureza: 1002')
            ->assertSee('Incidencia: IRRF')
            ->assertSee('eSocial: Sem codigo')
            ->assertSee('Vigencia: Ativa')
            ->assertSee('href="'.route('rubricas.index').'"', false);
    }
}
