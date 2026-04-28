<?php

namespace Tests\Feature;

use App\Models\EventoEsocial;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Tests\TestCase;

class OrgaoPublicoTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_open_orgao_publico_screen(): void
    {
        $tenant = $this->createTenant();
        $user = User::factory()->create([
            'tenant_id' => $tenant->id,
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('orgao-publico.show'));

        $response
            ->assertOk()
            ->assertSee('Base do orgao publico')
            ->assertSee($tenant->name);
    }

    public function test_orgao_publico_screen_explains_cpf_context_and_open_validity_window(): void
    {
        $tenant = $this->createTenant([
            'metadata' => [
                'orgao_publico' => [
                    'tipo_inscricao' => '2',
                    'numero_inscricao' => '529.982.247-25',
                    'classificacao_tributaria' => '21',
                    'inicio_validade' => '2026-04',
                    'fim_validade' => null,
                    'ambiente_esocial' => 'homologacao',
                ],
            ],
        ]);

        $user = User::factory()->create([
            'tenant_id' => $tenant->id,
        ]);

        $this
            ->actingAs($user)
            ->get(route('orgao-publico.show'))
            ->assertOk()
            ->assertSee('Nao se aplica para inscricao por CPF')
            ->assertSee('Vigencia ativa')
            ->assertSee('2026-04 ate Em aberto');
    }

    public function test_orgao_publico_edit_screen_explains_context_for_cnpj(): void
    {
        $tenant = $this->createTenant([
            'metadata' => [
                'orgao_publico' => [
                    'tipo_inscricao' => '1',
                    'numero_inscricao' => '11.222.333/0001-81',
                    'classificacao_tributaria' => '85',
                    'natureza_juridica' => '1244',
                    'inicio_validade' => '2026-04',
                    'fim_validade' => null,
                    'ambiente_esocial' => 'homologacao',
                ],
            ],
        ]);

        $user = User::factory()->create([
            'tenant_id' => $tenant->id,
        ]);

        $this
            ->actingAs($user)
            ->get(route('orgao-publico.edit'))
            ->assertOk()
            ->assertSee('Consistencia S-1000')
            ->assertSee('Contexto por CNPJ')
            ->assertSee('classificacao tributaria 85', false)
            ->assertSee('natureza juridica')
            ->assertSee('A combinacao atual esta alinhada com a regra de CNPJ.');
    }

    public function test_orgao_publico_edit_screen_explains_context_for_cpf(): void
    {
        $tenant = $this->createTenant([
            'metadata' => [
                'orgao_publico' => [
                    'tipo_inscricao' => '2',
                    'numero_inscricao' => '529.982.247-25',
                    'classificacao_tributaria' => '21',
                    'natureza_juridica' => null,
                    'inicio_validade' => '2026-04',
                    'fim_validade' => null,
                    'ambiente_esocial' => 'homologacao',
                ],
            ],
        ]);

        $user = User::factory()->create([
            'tenant_id' => $tenant->id,
        ]);

        $this
            ->actingAs($user)
            ->get(route('orgao-publico.edit'))
            ->assertOk()
            ->assertSee('Consistencia S-1000')
            ->assertSee('Contexto por CPF')
            ->assertSee('classificacao tributaria 21', false)
            ->assertSee('sera descartada no payload do `S-1000`.', false)
            ->assertSee('A combinacao atual esta alinhada com a regra de CPF.');
    }

    public function test_orgao_publico_screen_shows_classificacao_tributaria_description(): void
    {
        $tenant = $this->createTenant([
            'metadata' => [
                'orgao_publico' => [
                    'tipo_inscricao' => '1',
                    'numero_inscricao' => '11.222.333/0001-81',
                    'classificacao_tributaria' => '85',
                    'natureza_juridica' => '1244',
                    'inicio_validade' => '2026-04',
                    'fim_validade' => null,
                    'ambiente_esocial' => 'homologacao',
                ],
            ],
        ]);

        $user = User::factory()->create([
            'tenant_id' => $tenant->id,
        ]);

        $this
            ->actingAs($user)
            ->get(route('orgao-publico.show'))
            ->assertOk()
            ->assertSee('85 - Administracao publica direta, autarquias e fundacoes');
    }

    public function test_orgao_publico_screen_shows_validity_status(): void
    {
        $tenant = $this->createTenant([
            'metadata' => [
                'orgao_publico' => [
                    'tipo_inscricao' => '1',
                    'numero_inscricao' => '11.222.333/0001-81',
                    'classificacao_tributaria' => '85',
                    'natureza_juridica' => '1244',
                    'inicio_validade' => '2020-01',
                    'fim_validade' => null,
                    'ambiente_esocial' => 'homologacao',
                ],
            ],
        ]);

        $user = User::factory()->create([
            'tenant_id' => $tenant->id,
        ]);

        $this
            ->actingAs($user)
            ->get(route('orgao-publico.show'))
            ->assertOk()
            ->assertSee('Status de vigencia')
            ->assertSee('Vigencia ativa')
            ->assertSee('Ativa sem fim informado');
    }

    public function test_orgao_publico_screen_shows_s1000_readiness_when_base_is_consistent(): void
    {
        $tenant = $this->createTenant([
            'metadata' => [
                'orgao_publico' => [
                    'tipo_inscricao' => '1',
                    'numero_inscricao' => '11.222.333/0001-81',
                    'classificacao_tributaria' => '85',
                    'natureza_juridica' => '1244',
                    'inicio_validade' => '2020-01',
                    'fim_validade' => null,
                    'ambiente_esocial' => 'homologacao',
                ],
            ],
        ]);

        EventoEsocial::query()->create([
            'tenant_id' => $tenant->id,
            'evento' => 'S-1000',
            'status' => 'pendente',
            'ambiente' => 'homologacao',
            'payload' => ['origem' => 'parametros_orgao_publico'],
        ]);

        $user = User::factory()->create([
            'tenant_id' => $tenant->id,
        ]);

        $this
            ->actingAs($user)
            ->get(route('orgao-publico.show'))
            ->assertOk()
            ->assertSee('Prontidao S-1000')
            ->assertSee('Base S-1000 pronta')
            ->assertSee('Parametros minimos e evento local estao consistentes.')
            ->assertSee('Identificacao, classificacao, vigencia e evento local estao prontos');
    }

    public function test_orgao_publico_screen_lists_s1000_readiness_pending_items(): void
    {
        $tenant = $this->createTenant([
            'metadata' => [
                'orgao_publico' => [
                    'tipo_inscricao' => '1',
                    'numero_inscricao' => '11.222.333/0001-81',
                    'classificacao_tributaria' => '85',
                    'natureza_juridica' => null,
                    'inicio_validade' => '2099-01',
                    'fim_validade' => null,
                    'ambiente_esocial' => 'homologacao',
                ],
            ],
        ]);

        $user = User::factory()->create([
            'tenant_id' => $tenant->id,
        ]);

        $this
            ->actingAs($user)
            ->get(route('orgao-publico.show'))
            ->assertOk()
            ->assertSee('Base S-1000 com pendencias')
            ->assertSee('Revise os itens antes de preparar transmissao futura.')
            ->assertSee('Informe a natureza juridica para inscricoes por CNPJ.')
            ->assertSee('A vigencia do S-1000 ainda esta futura.')
            ->assertSee('Gere ou sincronize o evento S-1000 local.')
            ->assertSee('Corrigir parametros');
    }

    public function test_orgao_publico_screen_shows_future_and_closed_validity_statuses(): void
    {
        $tenant = $this->createTenant([
            'metadata' => [
                'orgao_publico' => [
                    'tipo_inscricao' => '1',
                    'numero_inscricao' => '11.222.333/0001-81',
                    'classificacao_tributaria' => '85',
                    'natureza_juridica' => '1244',
                    'inicio_validade' => '2099-01',
                    'fim_validade' => null,
                    'ambiente_esocial' => 'homologacao',
                ],
            ],
        ]);

        $user = User::factory()->create([
            'tenant_id' => $tenant->id,
        ]);

        $this
            ->actingAs($user)
            ->get(route('orgao-publico.show'))
            ->assertOk()
            ->assertSee('Vigencia futura')
            ->assertSee('Inicio previsto para 2099-01');

        $tenant->update([
            'metadata' => [
                'orgao_publico' => [
                    'tipo_inscricao' => '1',
                    'numero_inscricao' => '11.222.333/0001-81',
                    'classificacao_tributaria' => '85',
                    'natureza_juridica' => '1244',
                    'inicio_validade' => '2020-01',
                    'fim_validade' => '2020-12',
                    'ambiente_esocial' => 'homologacao',
                ],
            ],
        ]);

        $this
            ->actingAs($user)
            ->get(route('orgao-publico.show'))
            ->assertOk()
            ->assertSee('Vigencia encerrada')
            ->assertSee('Encerrada em 2020-12');
    }

    public function test_orgao_publico_screen_links_to_s1000_event_detail(): void
    {
        $tenant = $this->createTenant([
            'metadata' => [
                'orgao_publico' => [
                    'tipo_inscricao' => '1',
                    'numero_inscricao' => '11.222.333/0001-81',
                    'classificacao_tributaria' => '85',
                    'natureza_juridica' => '1244',
                    'inicio_validade' => '2026-04',
                    'fim_validade' => null,
                    'ambiente_esocial' => 'homologacao',
                ],
            ],
        ]);

        $user = User::factory()->create([
            'tenant_id' => $tenant->id,
        ]);

        $evento = EventoEsocial::query()->create([
            'tenant_id' => $tenant->id,
            'evento' => 'S-1000',
            'status' => 'pendente',
            'ambiente' => 'homologacao',
            'payload' => ['origem' => 'parametros_orgao_publico'],
        ]);

        $this
            ->actingAs($user)
            ->get(route('orgao-publico.show'))
            ->assertOk()
            ->assertSee('Detalhar evento')
            ->assertSee('Ver S-1000 no painel')
            ->assertSee('Abrir S-1000 no painel')
            ->assertSee('Mesmo status')
            ->assertSee('Mesmo ambiente')
            ->assertSee('href="'.route('eventos-esocial.show', $evento).'"', false)
            ->assertSee('href="'.route('eventos-esocial.index', ['evento' => 'S-1000']).'"', false)
            ->assertSee('evento=S-1000', false)
            ->assertSee('status=pendente', false)
            ->assertSee('ambiente=homologacao', false);
    }

    public function test_user_can_update_orgao_publico_and_generate_pending_s1000(): void
    {
        $tenant = $this->createTenant();
        $user = User::factory()->create([
            'tenant_id' => $tenant->id,
        ]);

        $response = $this
            ->actingAs($user)
            ->put(route('orgao-publico.update'), [
                'name' => 'Prefeitura Municipal do Sol',
                'tipo_inscricao' => '1',
                'numero_inscricao' => '11222333000181',
                'classificacao_tributaria' => '85',
                'natureza_juridica' => '1244',
                'inicio_validade' => '2026-04',
                'fim_validade' => '',
                'ambiente_esocial' => 'homologacao',
                'contato_nome' => 'Marina Souza',
                'contato_cpf' => '52998224725',
                'contato_email' => 'rh@sol.gov.br',
                'telefone' => '1133334444',
                'observacoes' => 'Cadastro inicial do orgao para trilha eSocial.',
            ]);

        $response
            ->assertRedirect(route('orgao-publico.show'))
            ->assertSessionHas('status');

        $tenant->refresh();

        $this->assertSame('Prefeitura Municipal do Sol', $tenant->name);
        $this->assertSame('11.222.333/0001-81', $tenant->metadata['orgao_publico']['numero_inscricao']);
        $this->assertSame('Marina Souza', $tenant->metadata['orgao_publico']['contato_nome']);

        $this->assertDatabaseHas('eventos_esocial', [
            'tenant_id' => $tenant->id,
            'evento' => 'S-1000',
            'status' => 'pendente',
            'ambiente' => 'homologacao',
        ]);
    }

    public function test_updating_orgao_publico_reuses_existing_pending_s1000_event(): void
    {
        $tenant = $this->createTenant([
            'metadata' => [
                'orgao_publico' => [
                    'tipo_inscricao' => '1',
                    'numero_inscricao' => '11.222.333/0001-81',
                    'inicio_validade' => '2026-01',
                    'ambiente_esocial' => 'homologacao',
                ],
            ],
        ]);

        $user = User::factory()->create([
            'tenant_id' => $tenant->id,
        ]);

        $evento = EventoEsocial::query()->create([
            'tenant_id' => $tenant->id,
            'servidor_id' => null,
            'evento' => 'S-1000',
            'status' => 'pendente',
            'ambiente' => 'homologacao',
            'payload' => ['controle_interno' => ['slug' => $tenant->slug]],
        ]);

        $this
            ->actingAs($user)
            ->put(route('orgao-publico.update'), [
                'name' => 'Prefeitura Municipal das Flores',
                'tipo_inscricao' => '1',
                'numero_inscricao' => '11222333000181',
                'classificacao_tributaria' => '85',
                'natureza_juridica' => '1244',
                'inicio_validade' => '2026-05',
                'fim_validade' => '',
                'ambiente_esocial' => 'producao',
                'contato_nome' => 'Joao Lima',
                'contato_cpf' => '52998224725',
                'contato_email' => 'folha@flores.gov.br',
                'telefone' => '1130304040',
                'observacoes' => '',
            ])
            ->assertRedirect(route('orgao-publico.show'));

        $this->assertSame(1, EventoEsocial::query()->where('tenant_id', $tenant->id)->where('evento', 'S-1000')->count());

        $evento->refresh();

        $this->assertSame('producao', $evento->ambiente);
        $this->assertSame('Prefeitura Municipal das Flores', data_get($evento->payload, 'infoEmpregador.inclusao.infoCadastro.nmRazao'));
        $this->assertSame('11222333000181', data_get($evento->payload, 'ideEmpregador.nrInsc'));
    }

    public function test_updating_orgao_publico_requires_classificacao_tributaria_and_natureza_juridica_for_cnpj(): void
    {
        $tenant = $this->createTenant();
        $user = User::factory()->create([
            'tenant_id' => $tenant->id,
        ]);

        $response = $this
            ->actingAs($user)
            ->from(route('orgao-publico.edit'))
            ->put(route('orgao-publico.update'), [
                'name' => 'Prefeitura Municipal do Sol',
                'tipo_inscricao' => '1',
                'numero_inscricao' => '11222333000181',
                'classificacao_tributaria' => '',
                'natureza_juridica' => '',
                'inicio_validade' => '2026-04',
                'fim_validade' => '',
                'ambiente_esocial' => 'homologacao',
                'contato_nome' => 'Marina Souza',
                'contato_cpf' => '52998224725',
                'contato_email' => 'rh@sol.gov.br',
                'telefone' => '1133334444',
                'observacoes' => 'Cadastro inicial do orgao para trilha eSocial.',
            ]);

        $response
            ->assertRedirect(route('orgao-publico.edit'))
            ->assertSessionHasErrors(['classificacao_tributaria', 'natureza_juridica']);

        $this->assertDatabaseMissing('eventos_esocial', [
            'tenant_id' => $tenant->id,
            'evento' => 'S-1000',
        ]);
    }

    public function test_updating_orgao_publico_rejects_unmapped_classificacao_tributaria(): void
    {
        $tenant = $this->createTenant();
        $user = User::factory()->create([
            'tenant_id' => $tenant->id,
        ]);

        $response = $this
            ->actingAs($user)
            ->from(route('orgao-publico.edit'))
            ->put(route('orgao-publico.update'), [
                'name' => 'Prefeitura Municipal do Sol',
                'tipo_inscricao' => '1',
                'numero_inscricao' => '11222333000181',
                'classificacao_tributaria' => '999',
                'natureza_juridica' => '1244',
                'inicio_validade' => '2026-04',
                'fim_validade' => '',
                'ambiente_esocial' => 'homologacao',
                'contato_nome' => 'Marina Souza',
                'contato_cpf' => '52998224725',
                'contato_email' => 'rh@sol.gov.br',
                'telefone' => '1133334444',
                'observacoes' => 'Cadastro inicial do orgao para trilha eSocial.',
            ]);

        $response
            ->assertRedirect(route('orgao-publico.edit'))
            ->assertSessionHasErrors(['classificacao_tributaria']);

        $this->assertDatabaseMissing('eventos_esocial', [
            'tenant_id' => $tenant->id,
            'evento' => 'S-1000',
        ]);
    }

    public function test_updating_orgao_publico_rejects_incompatible_classificacao_tributaria_for_inscricao_type(): void
    {
        $tenant = $this->createTenant();
        $user = User::factory()->create([
            'tenant_id' => $tenant->id,
        ]);

        $this
            ->actingAs($user)
            ->from(route('orgao-publico.edit'))
            ->put(route('orgao-publico.update'), [
                'name' => 'Prefeitura Municipal do Sol',
                'tipo_inscricao' => '1',
                'numero_inscricao' => '11222333000181',
                'classificacao_tributaria' => '21',
                'natureza_juridica' => '1244',
                'inicio_validade' => '2026-04',
                'fim_validade' => '',
                'ambiente_esocial' => 'homologacao',
                'contato_nome' => 'Marina Souza',
                'contato_cpf' => '52998224725',
                'contato_email' => 'rh@sol.gov.br',
                'telefone' => '1133334444',
                'observacoes' => '',
            ])
            ->assertRedirect(route('orgao-publico.edit'))
            ->assertSessionHasErrors(['classificacao_tributaria']);

        $this
            ->actingAs($user)
            ->from(route('orgao-publico.edit'))
            ->put(route('orgao-publico.update'), [
                'name' => 'Fundo Municipal de Apoio',
                'tipo_inscricao' => '2',
                'numero_inscricao' => '52998224725',
                'classificacao_tributaria' => '85',
                'natureza_juridica' => '',
                'inicio_validade' => '2026-04',
                'fim_validade' => '',
                'ambiente_esocial' => 'homologacao',
                'contato_nome' => '',
                'contato_cpf' => '',
                'contato_email' => '',
                'telefone' => '',
                'observacoes' => '',
            ])
            ->assertRedirect(route('orgao-publico.edit'))
            ->assertSessionHasErrors(['classificacao_tributaria']);

        $this->assertDatabaseMissing('eventos_esocial', [
            'tenant_id' => $tenant->id,
            'evento' => 'S-1000',
        ]);
    }

    public function test_updating_orgao_publico_rejects_invalid_document_check_digits(): void
    {
        $tenant = $this->createTenant();
        $user = User::factory()->create([
            'tenant_id' => $tenant->id,
        ]);

        $this
            ->actingAs($user)
            ->from(route('orgao-publico.edit'))
            ->put(route('orgao-publico.update'), [
                'name' => 'Prefeitura Municipal do Sol',
                'tipo_inscricao' => '1',
                'numero_inscricao' => '11222333000182',
                'classificacao_tributaria' => '85',
                'natureza_juridica' => '1244',
                'inicio_validade' => '2026-04',
                'fim_validade' => '',
                'ambiente_esocial' => 'homologacao',
                'contato_nome' => 'Marina Souza',
                'contato_cpf' => '52998224725',
                'contato_email' => 'rh@sol.gov.br',
                'telefone' => '1133334444',
                'observacoes' => 'Cadastro inicial do orgao para trilha eSocial.',
            ])
            ->assertRedirect(route('orgao-publico.edit'))
            ->assertSessionHasErrors(['numero_inscricao']);

        $this
            ->actingAs($user)
            ->from(route('orgao-publico.edit'))
            ->put(route('orgao-publico.update'), [
                'name' => 'Fundo Municipal de Apoio',
                'tipo_inscricao' => '2',
                'numero_inscricao' => '52998224726',
                'classificacao_tributaria' => '21',
                'natureza_juridica' => '',
                'inicio_validade' => '2026-04',
                'fim_validade' => '',
                'ambiente_esocial' => 'homologacao',
                'contato_nome' => '',
                'contato_cpf' => '',
                'contato_email' => '',
                'telefone' => '',
                'observacoes' => '',
            ])
            ->assertRedirect(route('orgao-publico.edit'))
            ->assertSessionHasErrors(['numero_inscricao']);

        $this
            ->actingAs($user)
            ->from(route('orgao-publico.edit'))
            ->put(route('orgao-publico.update'), [
                'name' => 'Prefeitura Municipal do Sol',
                'tipo_inscricao' => '1',
                'numero_inscricao' => '11222333000181',
                'classificacao_tributaria' => '85',
                'natureza_juridica' => '1244',
                'inicio_validade' => '2026-04',
                'fim_validade' => '',
                'ambiente_esocial' => 'homologacao',
                'contato_nome' => 'Marina Souza',
                'contato_cpf' => '52998224726',
                'contato_email' => 'rh@sol.gov.br',
                'telefone' => '1133334444',
                'observacoes' => 'Cadastro inicial do orgao para trilha eSocial.',
            ])
            ->assertRedirect(route('orgao-publico.edit'))
            ->assertSessionHasErrors(['contato_cpf']);

        $this->assertDatabaseMissing('eventos_esocial', [
            'tenant_id' => $tenant->id,
            'evento' => 'S-1000',
        ]);
    }

    public function test_updating_orgao_publico_omits_empty_contact_block_and_natureza_juridica_for_cpf(): void
    {
        $tenant = $this->createTenant();
        $user = User::factory()->create([
            'tenant_id' => $tenant->id,
        ]);

        $this
            ->actingAs($user)
            ->put(route('orgao-publico.update'), [
                'name' => 'Fundo Municipal de Apoio',
                'tipo_inscricao' => '2',
                'numero_inscricao' => '52998224725',
                'classificacao_tributaria' => '21',
                'natureza_juridica' => '1244',
                'inicio_validade' => '2026-04',
                'fim_validade' => '',
                'ambiente_esocial' => 'homologacao',
                'contato_nome' => '',
                'contato_cpf' => '',
                'contato_email' => '',
                'telefone' => '',
                'observacoes' => '',
            ])
            ->assertRedirect(route('orgao-publico.show'));

        $tenant->refresh();

        $this->assertNull($tenant->metadata['orgao_publico']['natureza_juridica']);

        $evento = EventoEsocial::query()
            ->where('tenant_id', $tenant->id)
            ->where('evento', 'S-1000')
            ->latest('id')
            ->firstOrFail();

        $this->assertSame('2', data_get($evento->payload, 'ideEmpregador.tpInsc'));
        $this->assertSame('52998224725', data_get($evento->payload, 'ideEmpregador.nrInsc'));
        $this->assertSame('21', data_get($evento->payload, 'infoEmpregador.inclusao.infoCadastro.classTrib'));
        $this->assertNull(data_get($evento->payload, 'infoEmpregador.inclusao.infoCadastro.natJurid'));
        $this->assertNull(data_get($evento->payload, 'infoEmpregador.inclusao.infoCadastro.contato'));
    }

    public function test_user_without_tenant_cannot_open_orgao_publico_screen(): void
    {
        $user = User::factory()->create([
            'tenant_id' => null,
        ]);

        $this
            ->actingAs($user)
            ->get(route('orgao-publico.show'))
            ->assertForbidden();
    }

    public function test_user_without_tenant_cannot_update_orgao_publico(): void
    {
        $user = User::factory()->create([
            'tenant_id' => null,
        ]);

        $this
            ->actingAs($user)
            ->put(route('orgao-publico.update'), [
                'name' => 'Prefeitura sem tenant',
                'tipo_inscricao' => '1',
                'numero_inscricao' => '11222333000181',
                'classificacao_tributaria' => '85',
                'natureza_juridica' => '1244',
                'inicio_validade' => '2026-04',
                'fim_validade' => '',
                'ambiente_esocial' => 'homologacao',
                'contato_nome' => '',
                'contato_cpf' => '',
                'contato_email' => '',
                'telefone' => '',
                'observacoes' => '',
            ])
            ->assertForbidden();
    }

    private function createTenant(array $overrides = []): Tenant
    {
        $this->ensureTenantsTableExists();

        return Tenant::query()->create(array_merge([
            'uuid' => (string) Str::uuid(),
            'name' => 'Prefeitura Base',
            'slug' => 'prefeitura-base-'.Str::lower(Str::random(6)),
            'domain' => 'prefeitura-base-'.Str::lower(Str::random(6)).'.local',
            'database' => 'tenant_'.Str::lower(Str::random(8)),
            'is_active' => true,
            'metadata' => [],
        ], $overrides));
    }

    private function ensureTenantsTableExists(): void
    {
        if (Schema::hasTable('tenants')) {
            return;
        }

        Schema::create('tenants', function (Blueprint $table): void {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('domain')->unique();
            $table->string('database')->unique();
            $table->boolean('is_active')->default(true);
            $table->json('metadata')->nullable();
            $table->timestamps();
        });
    }
}
