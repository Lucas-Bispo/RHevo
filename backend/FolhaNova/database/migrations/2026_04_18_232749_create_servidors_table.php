<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('servidores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id')->index();
            $table->foreignId('pessoa_id')->constrained('pessoas')->cascadeOnDelete();
            $table->unsignedBigInteger('lotacao_id')->nullable()->index();
            $table->unsignedBigInteger('cargo_id')->nullable()->index();
            $table->unsignedBigInteger('funcao_id')->nullable()->index();
            $table->string('matricula', 30);
            $table->string('tipo_vinculo', 50);
            $table->string('categoria_esocial', 10)->nullable();
            $table->string('regime_previdenciario', 20)->nullable();
            $table->date('data_admissao')->nullable();
            $table->date('data_desligamento')->nullable();
            $table->decimal('salario_base', 14, 2)->default(0);
            $table->string('situacao', 30)->default('ativo');
            $table->timestamps();

            $table->unique(['tenant_id', 'matricula']);
            $table->index(['tenant_id', 'situacao']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servidores');
    }
};
