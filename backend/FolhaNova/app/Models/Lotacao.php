<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lotacao extends Model
{
    use HasFactory;

    protected $table = 'lotacoes';

    protected $fillable = [
        'tenant_id',
        'codigo',
        'nome',
        'tipo',
        'codigo_esocial',
        'ativa',
    ];

    protected function casts(): array
    {
        return [
            'ativa' => 'boolean',
        ];
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function servidores(): HasMany
    {
        return $this->hasMany(Servidor::class);
    }
}
