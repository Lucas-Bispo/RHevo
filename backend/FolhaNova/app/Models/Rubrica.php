<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rubrica extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'codigo',
        'nome',
        'natureza',
        'tipo',
        'incide_irrf',
        'incide_inss',
        'incide_fgts',
        'codigo_esocial',
        'inicio_validade',
        'fim_validade',
        'ativo',
    ];

    protected function casts(): array
    {
        return [
            'incide_irrf' => 'boolean',
            'incide_inss' => 'boolean',
            'incide_fgts' => 'boolean',
            'inicio_validade' => 'date',
            'fim_validade' => 'date',
            'ativo' => 'boolean',
        ];
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }
}
