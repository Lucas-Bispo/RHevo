<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Pessoa física vinculada ao tenant.
 *
 * O cadastro de pessoa fica separado do vínculo funcional para permitir
 * histórico limpo e futuras recontratações sem duplicar dados pessoais.
 *
 * @property int $id
 * @property int $tenant_id
 * @property string $nome_completo
 * @property string $cpf
 */
class Pessoa extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'nome_completo',
        'nome_social',
        'cpf',
        'nis',
        'data_nascimento',
        'sexo',
        'estado_civil',
        'email',
        'telefone',
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'uf',
        'cep',
    ];

    protected function casts(): array
    {
        return [
            'data_nascimento' => 'date',
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
