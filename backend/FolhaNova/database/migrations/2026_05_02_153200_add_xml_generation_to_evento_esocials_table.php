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
        Schema::table('eventos_esocial', function (Blueprint $table) {
            $table->longText('xml_gerado')->nullable()->after('payload');
            $table->string('xml_hash', 64)->nullable()->after('xml_gerado');
            $table->string('xml_validacao_status', 40)->nullable()->after('xml_hash');
            $table->text('xml_validacao_mensagem')->nullable()->after('xml_validacao_status');
            $table->timestamp('xml_gerado_em')->nullable()->after('xml_validacao_mensagem');
            $table->timestamp('xml_validado_em')->nullable()->after('xml_gerado_em');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('eventos_esocial', function (Blueprint $table) {
            $table->dropColumn([
                'xml_gerado',
                'xml_hash',
                'xml_validacao_status',
                'xml_validacao_mensagem',
                'xml_gerado_em',
                'xml_validado_em',
            ]);
        });
    }
};
