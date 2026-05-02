<?php

namespace Database\Seeders;

use App\Models\Cargo;
use App\Models\EventoEsocial;
use App\Models\Funcao;
use App\Models\Lotacao;
use App\Models\Pessoa;
use App\Models\Rubrica;
use App\Models\Servidor;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        $this->ensureTenantsTableExists();

        $tenant = Tenant::query()->updateOrCreate(
            ['slug' => 'prefeitura-demo'],
            [
                'uuid' => (string) Str::uuid(),
                'name' => 'Prefeitura Demonstracao',
                'domain' => 'prefeitura-demo.local',
                'database' => 'tenant_prefeitura_demo',
                'is_active' => true,
                'metadata' => [
                    'orgao_publico' => [
                        'tipo_inscricao' => '1',
                        'numero_inscricao' => '11.222.333/0001-81',
                        'classificacao_tributaria' => '85',
                        'natureza_juridica' => '1244',
                        'inicio_validade' => '2026-01',
                        'fim_validade' => null,
                        'ambiente_esocial' => 'homologacao',
                        'contato_nome' => 'Marina Souza',
                        'contato_cpf' => '529.982.247-25',
                        'contato_email' => 'rh@demo.gov.br',
                        'telefone' => '(11) 3333-4444',
                        'observacoes' => 'Massa demo para validacao manual local.',
                    ],
                ],
            ],
        );

        User::query()->updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'tenant_id' => $tenant->id,
                'name' => 'Usuario Demo',
                'role' => 'tenant_admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ],
        );

        $lotacaoRh = $this->lotacao($tenant, 'RH', 'Secretaria de Administracao', 'secretaria', 'S1020-RH', true);
        $lotacaoEducacao = $this->lotacao($tenant, 'EDU', 'Secretaria de Educacao', 'secretaria', null, true);
        $lotacaoInativa = $this->lotacao($tenant, 'ARQ', 'Arquivo Historico', 'setor', null, false);

        $cargoAnalista = $this->cargo($tenant, 'ANL-RH', 'Analista de Recursos Humanos', 'Cargo efetivo de apoio ao RH.', 'CARGO-ANL-RH', true);
        $cargoProfessor = $this->cargo($tenant, 'PROF', 'Professor de Educacao Basica', 'Cargo efetivo da rede municipal.', 'CARGO-PROF', true);
        $cargoAuxiliar = $this->cargo($tenant, 'AUX-ADM', 'Auxiliar Administrativo', 'Cargo administrativo em extincao.', null, false);

        $funcaoCoordenador = $this->funcao($tenant, 'COORD-RH', 'Coordenador de RH', 'Funcao gratificada de coordenacao.', 'FUN-COORD-RH', true);
        $funcaoDiretor = $this->funcao($tenant, 'DIR-ESC', 'Diretor Escolar', 'Funcao gratificada escolar.', null, true);

        $ana = $this->servidor($tenant, [
            'pessoa' => [
                'nome_completo' => 'Ana Paula Martins',
                'cpf' => '529.982.247-25',
                'nis' => '12345678901',
                'data_nascimento' => '1988-04-12',
                'sexo' => 'feminino',
                'email' => 'ana.martins@demo.gov.br',
            ],
            'servidor' => [
                'lotacao_id' => $lotacaoRh->id,
                'cargo_id' => $cargoAnalista->id,
                'funcao_id' => $funcaoCoordenador->id,
                'matricula' => 'MAT-0001',
                'tipo_vinculo' => 'estatutario',
                'categoria_esocial' => '301',
                'regime_previdenciario' => 'rpPS',
                'data_admissao' => '2024-01-15',
                'salario_base' => 5200,
                'situacao' => 'ativo',
            ],
        ]);

        $bruno = $this->servidor($tenant, [
            'pessoa' => [
                'nome_completo' => 'Bruno Henrique Lima',
                'cpf' => '111.444.777-35',
                'nis' => '98765432100',
                'data_nascimento' => '1991-09-03',
                'sexo' => 'masculino',
                'email' => 'bruno.lima@demo.gov.br',
            ],
            'servidor' => [
                'lotacao_id' => $lotacaoEducacao->id,
                'cargo_id' => $cargoProfessor->id,
                'funcao_id' => $funcaoDiretor->id,
                'matricula' => 'MAT-0002',
                'tipo_vinculo' => 'estatutario',
                'categoria_esocial' => '301',
                'regime_previdenciario' => 'rpPS',
                'data_admissao' => '2023-02-01',
                'salario_base' => 6100,
                'situacao' => 'ativo',
            ],
        ]);

        $this->servidor($tenant, [
            'pessoa' => [
                'nome_completo' => 'Carla Beatriz Rocha',
                'cpf' => '390.533.447-05',
                'nis' => '19283746500',
                'data_nascimento' => '1979-11-21',
                'sexo' => 'feminino',
                'email' => 'carla.rocha@demo.gov.br',
            ],
            'servidor' => [
                'lotacao_id' => $lotacaoInativa->id,
                'cargo_id' => $cargoAuxiliar->id,
                'funcao_id' => null,
                'matricula' => 'MAT-0003',
                'tipo_vinculo' => 'comissionado',
                'categoria_esocial' => '302',
                'regime_previdenciario' => 'rgPS',
                'data_admissao' => '2022-05-10',
                'data_desligamento' => '2026-02-28',
                'salario_base' => 3800,
                'situacao' => 'desligado',
            ],
        ]);

        $this->rubrica($tenant, 'VENC', 'Vencimento base', '1000', 'provento', true, true, true, 'S1010-VENC', true, '2026-01-01');
        $this->rubrica($tenant, 'AD-NOT', 'Adicional noturno', '1002', 'provento', true, true, true, 'S1010-ADNOT', true, '2026-02-01');
        $this->rubrica($tenant, 'DESC-SIND', 'Desconto sindical', '9219', 'desconto', false, false, false, null, true, '2026-01-01');
        $this->rubrica($tenant, 'AUX-ALIM', 'Auxilio alimentacao programado', '1801', 'informativa', false, false, false, null, false, '2026-06-01', '2026-12-31');
        $this->rubrica($tenant, 'RUB-INAT', 'Rubrica inativa historica', '1002', 'provento', true, true, false, 'S1010-INAT', false, '2025-01-01', '2026-03-31');

        $this->evento($tenant, null, 'S-1000', 'processado', 'homologacao', 'PROTO-S1000', 'REC-S1000', 'Evento S-1000 processado no ambiente demo.', [
            'origem' => 'parametros_orgao_publico',
            'ideEmpregador' => ['tpInsc' => '1', 'nrInsc' => '11222333'],
        ]);
        $this->evento($tenant, null, 'S-1010', 'erro', 'homologacao', null, null, 'Rubrica sem codigo eSocial pendente de revisao.', [
            'origem' => 'rubricas',
            'rubrica' => 'DESC-SIND',
        ]);
        $this->evento($tenant, $ana, 'S-2200', 'pendente', 'homologacao', null, null, null, [
            'origem' => 'cadastro_inicial_servidor',
            'matricula' => 'MAT-0001',
        ]);
        $this->evento($tenant, $bruno, 'S-2200', 'processado', 'homologacao', 'PROTO-S2200', 'REC-S2200', 'Admissao processada no ambiente demo.', [
            'origem' => 'cadastro_inicial_servidor',
            'matricula' => 'MAT-0002',
        ]);
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

    private function lotacao(Tenant $tenant, string $codigo, string $nome, string $tipo, ?string $codigoEsocial, bool $ativa): Lotacao
    {
        return Lotacao::query()->updateOrCreate(
            ['tenant_id' => $tenant->id, 'codigo' => $codigo],
            ['nome' => $nome, 'tipo' => $tipo, 'codigo_esocial' => $codigoEsocial, 'ativa' => $ativa],
        );
    }

    private function cargo(Tenant $tenant, string $codigo, string $nome, string $descricao, ?string $codigoEsocial, bool $ativo): Cargo
    {
        return Cargo::query()->updateOrCreate(
            ['tenant_id' => $tenant->id, 'codigo' => $codigo],
            ['nome' => $nome, 'descricao' => $descricao, 'codigo_esocial' => $codigoEsocial, 'ativo' => $ativo],
        );
    }

    private function funcao(Tenant $tenant, string $codigo, string $nome, string $descricao, ?string $codigoEsocial, bool $ativo): Funcao
    {
        return Funcao::query()->updateOrCreate(
            ['tenant_id' => $tenant->id, 'codigo' => $codigo],
            ['nome' => $nome, 'descricao' => $descricao, 'codigo_esocial' => $codigoEsocial, 'ativo' => $ativo],
        );
    }

    /**
     * @param  array{pessoa: array<string, mixed>, servidor: array<string, mixed>}  $payload
     */
    private function servidor(Tenant $tenant, array $payload): Servidor
    {
        $pessoa = Pessoa::query()->updateOrCreate(
            ['tenant_id' => $tenant->id, 'cpf' => $payload['pessoa']['cpf']],
            $payload['pessoa'],
        );

        return Servidor::query()->updateOrCreate(
            ['tenant_id' => $tenant->id, 'matricula' => $payload['servidor']['matricula']],
            array_merge($payload['servidor'], ['pessoa_id' => $pessoa->id]),
        );
    }

    private function rubrica(
        Tenant $tenant,
        string $codigo,
        string $nome,
        string $natureza,
        string $tipo,
        bool $incideIrrf,
        bool $incideInss,
        bool $incideFgts,
        ?string $codigoEsocial,
        bool $ativo,
        string $inicioValidade,
        ?string $fimValidade = null
    ): Rubrica {
        return Rubrica::query()->updateOrCreate(
            ['tenant_id' => $tenant->id, 'codigo' => $codigo],
            [
                'nome' => $nome,
                'natureza' => $natureza,
                'tipo' => $tipo,
                'incide_irrf' => $incideIrrf,
                'incide_inss' => $incideInss,
                'incide_fgts' => $incideFgts,
                'codigo_esocial' => $codigoEsocial,
                'inicio_validade' => $inicioValidade,
                'fim_validade' => $fimValidade,
                'ativo' => $ativo,
            ],
        );
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    private function evento(
        Tenant $tenant,
        ?Servidor $servidor,
        string $evento,
        string $status,
        string $ambiente,
        ?string $protocolo,
        ?string $recibo,
        ?string $mensagemRetorno,
        array $payload
    ): EventoEsocial {
        return EventoEsocial::query()->updateOrCreate(
            [
                'tenant_id' => $tenant->id,
                'servidor_id' => $servidor?->id,
                'evento' => $evento,
                'status' => $status,
            ],
            [
                'ambiente' => $ambiente,
                'protocolo' => $protocolo,
                'recibo' => $recibo,
                'mensagem_retorno' => $mensagemRetorno,
                'enviado_em' => $protocolo !== null ? now()->subMinutes(20) : null,
                'processado_em' => $recibo !== null || $mensagemRetorno !== null ? now()->subMinutes(10) : null,
                'payload' => $payload,
            ],
        );
    }
}
