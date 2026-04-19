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
        Schema::create('rubricas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id')->index();
            $table->string('codigo', 30);
            $table->string('nome');
            $table->string('natureza', 30);
            $table->string('tipo', 30);
            $table->boolean('incide_irrf')->default(false);
            $table->boolean('incide_inss')->default(false);
            $table->boolean('incide_fgts')->default(false);
            $table->string('codigo_esocial', 30)->nullable();
            $table->boolean('ativo')->default(true);
            $table->timestamps();

            $table->unique(['tenant_id', 'codigo']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rubricas');
    }
};
