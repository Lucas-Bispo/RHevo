<?php

namespace Tests\Feature;

use App\Models\EventoEsocial;
use App\Models\Rubrica;
use App\Models\Servidor;
use App\Models\Tenant;
use App\Models\User;
use Database\Seeders\DemoDataSeeder;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class DemoDataSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_demo_data_seeder_creates_manual_validation_dataset(): void
    {
        Carbon::setTestNow('2026-04-24 10:00:00');

        $this->ensureTenantsTableExists();

        $this->seed(DemoDataSeeder::class);
        $this->seed(DemoDataSeeder::class);

        $tenant = Tenant::query()->where('slug', 'prefeitura-demo')->firstOrFail();

        $this->assertSame('Prefeitura Demonstracao', $tenant->name);
        $this->assertSame(1, User::query()->where('email', 'test@example.com')->count());
        $this->assertSame($tenant->id, User::query()->where('email', 'test@example.com')->value('tenant_id'));
        $this->assertSame(3, Servidor::query()->where('tenant_id', $tenant->id)->count());
        $this->assertSame(5, Rubrica::query()->where('tenant_id', $tenant->id)->count());
        $this->assertSame(4, EventoEsocial::query()->where('tenant_id', $tenant->id)->count());

        $this->assertDatabaseHas('eventos_esocial', [
            'tenant_id' => $tenant->id,
            'evento' => 'S-1010',
            'status' => 'erro',
            'mensagem_retorno' => 'Rubrica sem codigo eSocial pendente de revisao.',
        ]);

        $this->assertDatabaseHas('rubricas', [
            'tenant_id' => $tenant->id,
            'codigo' => 'DESC-SIND',
            'codigo_esocial' => null,
            'inicio_validade' => '2026-01-01 00:00:00',
        ]);

        $this->assertDatabaseHas('rubricas', [
            'tenant_id' => $tenant->id,
            'codigo' => 'AUX-ALIM',
            'inicio_validade' => '2026-06-01 00:00:00',
            'fim_validade' => '2026-12-31 00:00:00',
            'ativo' => false,
        ]);

        $this->assertDatabaseHas('rubricas', [
            'tenant_id' => $tenant->id,
            'codigo' => 'RUB-INAT',
            'inicio_validade' => '2025-01-01 00:00:00',
            'fim_validade' => '2026-03-31 00:00:00',
            'ativo' => false,
        ]);

        $this->assertSame(3, Rubrica::query()
            ->where('tenant_id', $tenant->id)
            ->whereDate('inicio_validade', '<=', '2026-04-24')
            ->where(function ($query) {
                $query->whereNull('fim_validade')->orWhereDate('fim_validade', '>=', '2026-04-24');
            })
            ->count());

        $this->assertSame(1, Rubrica::query()
            ->where('tenant_id', $tenant->id)
            ->whereDate('inicio_validade', '>', '2026-04-24')
            ->count());

        $this->assertSame(1, Rubrica::query()
            ->where('tenant_id', $tenant->id)
            ->whereNotNull('fim_validade')
            ->whereDate('fim_validade', '<', '2026-04-24')
            ->count());

        Carbon::setTestNow();
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
