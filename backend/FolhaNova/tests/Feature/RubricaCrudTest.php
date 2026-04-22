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
                'natureza' => '1000',
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
            'natureza' => '1000',
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
            'ativo' => false,
        ]);
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
            ->assertSee('href="'.route('eventos-esocial.index', ['evento' => 'S-1010']).'"', false)
            ->assertSee('href="'.route('rubricas.index', ['esocial' => 'sem_codigo']).'"', false);
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
                'ativo' => '1',
            ]);

        $response
            ->assertRedirect(route('rubricas.create'))
            ->assertSessionHasErrors('codigo');

        $this->assertSame(1, Rubrica::query()->where('tenant_id', 65)->where('codigo', 'RUB-001')->count());
    }
}
