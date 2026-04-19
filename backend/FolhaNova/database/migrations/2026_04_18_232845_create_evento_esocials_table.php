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
        Schema::create('eventos_esocial', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id')->index();
            $table->foreignId('servidor_id')->nullable()->constrained('servidores')->nullOnDelete();
            $table->string('evento', 20);
            $table->string('status', 30)->default('pendente');
            $table->string('ambiente', 20)->default('homologacao');
            $table->json('payload')->nullable();
            $table->string('recibo')->nullable();
            $table->string('protocolo')->nullable();
            $table->text('mensagem_retorno')->nullable();
            $table->timestamp('enviado_em')->nullable();
            $table->timestamp('processado_em')->nullable();
            $table->timestamps();

            $table->index(['tenant_id', 'evento', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos_esocial');
    }
};
