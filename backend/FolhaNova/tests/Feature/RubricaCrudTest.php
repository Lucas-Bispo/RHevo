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
            ->assertSee('Cadastro de rubrica')
            ->assertSee('Apoio S-1010')
            ->assertSee('Ver S-1010 no painel')
            ->assertSee('Ver pendencias sem codigo')
            ->assertSee('Ver rubricas com codigo')
            ->assertSee('Ver rubricas ativas')
            ->assertSee('href="'.route('eventos-esocial.index', ['evento' => 'S-1010']).'"', false)
            ->assertSee('href="'.route('rubricas.index', ['esocial' => 'sem_codigo']).'"', false)
            ->assertSee('href="'.route('rubricas.index', ['esocial' => 'com_codigo']).'"', false)
            ->assertSee('href="'.route('rubricas.index', ['status' => 'ativos']).'"', false);
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
                'natureza' => '1000',
                'tipo' => 'provento',
                'incide_irrf' => '1',
                'incide_inss' => '1',
                'incide_fgts' => '0',
                'codigo_esocial' => 'S1010-GRAT',
                'inicio_validade' => '2026-01-01',
                'fim_validade' => '2026-12-31',
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
            'natureza' => '1000',
            'incide_irrf' => true,
            'incide_inss' => true,
            'incide_fgts' => false,
            'inicio_validade' => '2026-01-01 00:00:00',
            'fim_validade' => '2026-12-31 00:00:00',
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
            'natureza' => '9201',
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
                'natureza' => '9219',
                'tipo' => 'desconto',
                'incide_irrf' => '0',
                'incide_inss' => '0',
                'incide_fgts' => '0',
                'codigo_esocial' => 'S1010-DESC',
                'inicio_validade' => '2026-02-01',
                'fim_validade' => '2026-12-31',
                'ativo' => '0',
            ]);

        $response
            ->assertRedirect(route('rubricas.index'))
            ->assertSessionHas('status');

        $this->assertDatabaseHas('rubricas', [
            'id' => $rubrica->id,
            'nome' => 'Desconto sindical',
            'natureza' => '9219',
            'codigo_esocial' => 'S1010-DESC',
            'inicio_validade' => '2026-02-01 00:00:00',
            'fim_validade' => '2026-12-31 00:00:00',
            'ativo' => false,
        ]);
    }

    public function test_user_can_not_update_inactive_rubrica_without_end_of_validity(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 92,
        ]);

        $rubrica = Rubrica::create([
            'tenant_id' => 92,
            'codigo' => 'RUB-ATV',
            'nome' => 'Rubrica ativa',
            'natureza' => '1000',
            'tipo' => 'provento',
            'incide_irrf' => true,
            'incide_inss' => true,
            'incide_fgts' => false,
            'inicio_validade' => '2026-01-01',
            'ativo' => true,
        ]);

        $response = $this
            ->actingAs($user)
            ->from(route('rubricas.edit', $rubrica))
            ->put(route('rubricas.update', $rubrica), [
                'codigo' => 'RUB-ATV',
                'nome' => 'Rubrica encerrada sem fim',
                'natureza' => '1000',
                'tipo' => 'provento',
                'incide_irrf' => '1',
                'incide_inss' => '1',
                'incide_fgts' => '0',
                'codigo_esocial' => 'S1010-ATV',
                'inicio_validade' => '2026-01-01',
                'fim_validade' => '',
                'ativo' => '0',
            ]);

        $response
            ->assertRedirect(route('rubricas.edit', $rubrica))
            ->assertSessionHasErrors('fim_validade');
    }

    public function test_user_can_not_update_active_rubrica_with_past_end_of_validity(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 93,
        ]);

        $rubrica = Rubrica::create([
            'tenant_id' => 93,
            'codigo' => 'RUB-VIG-ATV',
            'nome' => 'Rubrica com vigencia ativa',
            'natureza' => '1000',
            'tipo' => 'provento',
            'incide_irrf' => true,
            'incide_inss' => true,
            'incide_fgts' => false,
            'inicio_validade' => '2026-01-01',
            'ativo' => true,
        ]);

        $response = $this
            ->actingAs($user)
            ->from(route('rubricas.edit', $rubrica))
            ->put(route('rubricas.update', $rubrica), [
                'codigo' => 'RUB-VIG-ATV',
                'nome' => 'Rubrica ativa encerrada no passado',
                'natureza' => '1000',
                'tipo' => 'provento',
                'incide_irrf' => '1',
                'incide_inss' => '1',
                'incide_fgts' => '0',
                'codigo_esocial' => 'S1010-VIG-ATV',
                'inicio_validade' => '2026-01-01',
                'fim_validade' => '2026-04-22',
                'ativo' => '1',
            ]);

        $response
            ->assertRedirect(route('rubricas.edit', $rubrica))
            ->assertSessionHasErrors('fim_validade');
    }

    public function test_user_can_not_create_rubrica_with_invalid_vigencia_range(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 67,
        ]);

        $response = $this
            ->actingAs($user)
            ->from(route('rubricas.create'))
            ->post(route('rubricas.store'), [
                'codigo' => 'RUB-VIG',
                'nome' => 'Rubrica com vigencia invalida',
                'natureza' => '1000',
                'tipo' => 'provento',
                'incide_irrf' => '1',
                'incide_inss' => '1',
                'incide_fgts' => '0',
                'codigo_esocial' => 'S1010-VIG',
                'inicio_validade' => '2026-12-31',
                'fim_validade' => '2026-01-01',
                'ativo' => '1',
            ]);

        $response
            ->assertRedirect(route('rubricas.create'))
            ->assertSessionHasErrors('fim_validade');
    }

    public function test_user_can_not_create_inactive_rubrica_without_end_of_validity(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 91,
        ]);

        $response = $this
            ->actingAs($user)
            ->from(route('rubricas.create'))
            ->post(route('rubricas.store'), [
                'codigo' => 'RUB-INAT',
                'nome' => 'Rubrica inativa sem fim',
                'natureza' => '1000',
                'tipo' => 'provento',
                'incide_irrf' => '1',
                'incide_inss' => '1',
                'incide_fgts' => '0',
                'codigo_esocial' => 'S1010-INAT',
                'inicio_validade' => '2026-01-01',
                'fim_validade' => '',
                'ativo' => '0',
            ]);

        $response
            ->assertRedirect(route('rubricas.create'))
            ->assertSessionHasErrors('fim_validade');
    }

    public function test_user_can_not_create_active_rubrica_with_past_end_of_validity(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 94,
        ]);

        $response = $this
            ->actingAs($user)
            ->from(route('rubricas.create'))
            ->post(route('rubricas.store'), [
                'codigo' => 'RUB-PAST',
                'nome' => 'Rubrica ativa com fim passado',
                'natureza' => '1000',
                'tipo' => 'provento',
                'incide_irrf' => '1',
                'incide_inss' => '1',
                'incide_fgts' => '0',
                'codigo_esocial' => 'S1010-PAST',
                'inicio_validade' => '2026-01-01',
                'fim_validade' => '2026-04-22',
                'ativo' => '1',
            ]);

        $response
            ->assertRedirect(route('rubricas.create'))
            ->assertSessionHasErrors('fim_validade');
    }

    public function test_rubrica_edit_screen_shows_s1010_review_shortcuts(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 66,
        ]);

        $rubrica = Rubrica::create([
            'tenant_id' => 66,
            'codigo' => 'RUB-REV',
            'nome' => 'Rubrica revisao',
            'natureza' => '1000',
            'tipo' => 'provento',
            'incide_irrf' => true,
            'incide_inss' => true,
            'incide_fgts' => false,
            'ativo' => true,
        ]);

        $this
            ->actingAs($user)
            ->get(route('rubricas.edit', $rubrica))
            ->assertOk()
            ->assertSee('Revisao S-1010')
            ->assertSee('Ver S-1010 no painel')
            ->assertSee('Ver pendencias sem codigo')
            ->assertSee('Ver rubricas ativas')
            ->assertSee('Ver proventos')
            ->assertSee('Ver base IRRF')
            ->assertSee('Ver base INSS')
            ->assertSee('href="'.route('eventos-esocial.index', ['evento' => 'S-1010']).'"', false)
            ->assertSee('href="'.route('rubricas.index', ['esocial' => 'sem_codigo']).'"', false)
            ->assertSee('href="'.route('rubricas.index', ['status' => 'ativos']).'"', false)
            ->assertSee('href="'.route('rubricas.index', ['tipo' => 'provento']).'"', false)
            ->assertSee('href="'.route('rubricas.index', ['incidencia' => 'irrf']).'"', false)
            ->assertSee('href="'.route('rubricas.index', ['incidencia' => 'inss']).'"', false);
    }

    public function test_rubrica_edit_screen_adapts_contextual_s1010_shortcuts_to_current_rubrica(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 69,
        ]);

        $rubrica = Rubrica::create([
            'tenant_id' => 69,
            'codigo' => 'DESC-FGTS',
            'nome' => 'Desconto consignado FGTS',
            'natureza' => '9219',
            'tipo' => 'desconto',
            'incide_irrf' => false,
            'incide_inss' => false,
            'incide_fgts' => true,
            'codigo_esocial' => 'S1010-DESC-FGTS',
            'ativo' => false,
        ]);

        $this
            ->actingAs($user)
            ->get(route('rubricas.edit', $rubrica))
            ->assertOk()
            ->assertSee('Ver rubricas com codigo')
            ->assertSee('Ver rubricas inativas')
            ->assertSee('Ver descontos')
            ->assertSee('Ver base FGTS')
            ->assertDontSee('Ver base IRRF')
            ->assertDontSee('Ver base INSS')
            ->assertSee('href="'.route('rubricas.index', ['esocial' => 'com_codigo']).'"', false)
            ->assertSee('href="'.route('rubricas.index', ['status' => 'inativos']).'"', false)
            ->assertSee('href="'.route('rubricas.index', ['tipo' => 'desconto']).'"', false)
            ->assertSee('href="'.route('rubricas.index', ['incidencia' => 'fgts']).'"', false);
    }

    public function test_user_can_not_create_rubrica_with_textual_natureza(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 64,
        ]);

        $response = $this
            ->actingAs($user)
            ->post(route('rubricas.store'), [
                'codigo' => 'RUB-TXT',
                'nome' => 'Rubrica invalida',
                'natureza' => 'Vencimento',
                'tipo' => 'provento',
                'incide_irrf' => '1',
                'incide_inss' => '1',
                'incide_fgts' => '0',
                'codigo_esocial' => 'S1010-TXT',
                'ativo' => '1',
            ]);

        $response->assertSessionHasErrors('natureza');
    }

    public function test_user_can_not_create_rubrica_with_duplicate_codigo_surrounded_by_spaces(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 65,
        ]);

        Rubrica::create([
            'tenant_id' => 65,
            'codigo' => 'RUB-001',
            'nome' => 'Gratificacao de funcao',
            'natureza' => '1000',
            'tipo' => 'provento',
            'incide_irrf' => true,
            'incide_inss' => true,
            'incide_fgts' => false,
            'ativo' => true,
        ]);

        $response = $this
            ->actingAs($user)
            ->from(route('rubricas.create'))
            ->post(route('rubricas.store'), [
                'codigo' => ' RUB-001 ',
                'nome' => 'Outra gratificacao',
                'natureza' => '1000',
                'tipo' => 'provento',
                'incide_irrf' => '1',
                'incide_inss' => '1',
                'incide_fgts' => '0',
                'codigo_esocial' => '',
                'inicio_validade' => '2026-01-01',
                'fim_validade' => '',
                'ativo' => '1',
            ]);

        $response
            ->assertRedirect(route('rubricas.create'))
            ->assertSessionHasErrors('codigo');

        $this->assertSame(1, Rubrica::query()->where('tenant_id', 65)->where('codigo', 'RUB-001')->count());
    }

    public function test_user_can_not_create_rubrica_with_duplicate_codigo_esocial_in_same_tenant(): void
    {
        $user = User::factory()->create([
            'tenant_id' => 68,
        ]);

        Rubrica::create([
            'tenant_id' => 68,
            'codigo' => 'RUB-BASE',
            'nome' => 'Vencimento base',
            'natureza' => '1000',
            'tipo' => 'provento',
            'incide_irrf' => true,
            'incide_inss' => true,
            'incide_fgts' => false,
            'codigo_esocial' => 'S1010-BASE',
            'ativo' => true,
        ]);

        $response = $this
            ->actingAs($user)
            ->from(route('rubricas.create'))
            ->post(route('rubricas.store'), [
                'codigo' => 'RUB-BASE-2',
                'nome' => 'Vencimento base duplicado',
                'natureza' => '1000',
                'tipo' => 'provento',
                'incide_irrf' => '1',
                'incide_inss' => '1',
                'incide_fgts' => '0',
                'codigo_esocial' => ' s1010-base ',
                'inicio_validade' => '2026-01-01',
                'fim_validade' => '',
                'ativo' => '1',
            ]);

        $response
            ->assertRedirect(route('rubricas.create'))
            ->assertSessionHasErrors('codigo_esocial');

        $this->assertSame(1, Rubrica::query()->where('tenant_id', 68)->where('codigo_esocial', 'S1010-BASE')->count());
    }
}
