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
                    'numero_inscricao' => '123.456.789-01',
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
            ->assertSee('Cadastro com vigencia em aberto')
            ->assertSee('2026-04 ate Em aberto');
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
                'numero_inscricao' => '12345678000199',
                'classificacao_tributaria' => '85',
                'natureza_juridica' => '1244',
                'inicio_validade' => '2026-04',
                'fim_validade' => '',
                'ambiente_esocial' => 'homologacao',
                'contato_nome' => 'Marina Souza',
                'contato_cpf' => '12345678901',
                'contato_email' => 'rh@sol.gov.br',
                'telefone' => '1133334444',
                'observacoes' => 'Cadastro inicial do orgao para trilha eSocial.',
            ]);

        $response
            ->assertRedirect(route('orgao-publico.show'))
            ->assertSessionHas('status');

        $tenant->refresh();

        $this->assertSame('Prefeitura Municipal do Sol', $tenant->name);
        $this->assertSame('12.345.678/0001-99', $tenant->metadata['orgao_publico']['numero_inscricao']);
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
                    'numero_inscricao' => '98.765.432/0001-10',
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
                'numero_inscricao' => '98765432000110',
                'classificacao_tributaria' => '85',
                'natureza_juridica' => '1244',
                'inicio_validade' => '2026-05',
                'fim_validade' => '',
                'ambiente_esocial' => 'producao',
                'contato_nome' => 'Joao Lima',
                'contato_cpf' => '98765432100',
                'contato_email' => 'folha@flores.gov.br',
                'telefone' => '1130304040',
                'observacoes' => '',
            ])
            ->assertRedirect(route('orgao-publico.show'));

        $this->assertSame(1, EventoEsocial::query()->where('tenant_id', $tenant->id)->where('evento', 'S-1000')->count());

        $evento->refresh();

        $this->assertSame('producao', $evento->ambiente);
        $this->assertSame('Prefeitura Municipal das Flores', data_get($evento->payload, 'infoEmpregador.inclusao.infoCadastro.nmRazao'));
        $this->assertSame('98765432000110', data_get($evento->payload, 'ideEmpregador.nrInsc'));
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
                'numero_inscricao' => '12345678000199',
                'classificacao_tributaria' => '',
                'natureza_juridica' => '',
                'inicio_validade' => '2026-04',
                'fim_validade' => '',
                'ambiente_esocial' => 'homologacao',
                'contato_nome' => 'Marina Souza',
                'contato_cpf' => '12345678901',
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
                'numero_inscricao' => '12345678901',
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
            ->assertRedirect(route('orgao-publico.show'));

        $evento = EventoEsocial::query()
            ->where('tenant_id', $tenant->id)
            ->where('evento', 'S-1000')
            ->latest('id')
            ->firstOrFail();

        $this->assertSame('2', data_get($evento->payload, 'ideEmpregador.tpInsc'));
        $this->assertSame('12345678901', data_get($evento->payload, 'ideEmpregador.nrInsc'));
        $this->assertSame('21', data_get($evento->payload, 'infoEmpregador.inclusao.infoCadastro.classTrib'));
        $this->assertNull(data_get($evento->payload, 'infoEmpregador.inclusao.infoCadastro.natJurid'));
        $this->assertNull(data_get($evento->payload, 'infoEmpregador.inclusao.infoCadastro.contato'));
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
