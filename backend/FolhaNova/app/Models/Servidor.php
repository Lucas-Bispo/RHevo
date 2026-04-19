<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Vínculo funcional do servidor com a prefeitura.
 *
 * A separação entre Pessoa e Servidor facilita rastrear múltiplos vínculos,
 * progressões e estados funcionais sem contaminar o cadastro civil.
 */
class Servidor extends Model
{
    use HasFactory;

    protected $table = 'servidores';

    protected $fillable = [
        'tenant_id',
        'pessoa_id',
        'lotacao_id',
        'cargo_id',
        'funcao_id',
        'matricula',
        'tipo_vinculo',
        'categoria_esocial',
        'regime_previdenciario',
        'data_admissao',
        'data_desligamento',
        'salario_base',
        'situacao',
    ];

    protected function casts(): array
    {
        return [
            'data_admissao' => 'date',
            'data_desligamento' => 'date',
            'salario_base' => 'decimal:2',
        ];
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function pessoa(): BelongsTo
    {
        return $this->belongsTo(Pessoa::class);
    }

    public function lotacao(): BelongsTo
    {
        return $this->belongsTo(Lotacao::class);
    }

    public function cargo(): BelongsTo
    {
        return $this->belongsTo(Cargo::class);
    }

    public function funcao(): BelongsTo
    {
        return $this->belongsTo(Funcao::class);
    }

    public function eventosEsocial(): HasMany
    {
        return $this->hasMany(EventoEsocial::class);
    }
}
