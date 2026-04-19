<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Modelo de tenant landlord.
 *
 * Representa uma prefeitura ou entidade operada na instalação multi-tenant.
 *
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property string $slug
 * @property string|null $domain
 * @property string $database
 * @property bool $is_active
 */
class Tenant extends Model
{
    use HasFactory;

    /**
     * Campos atribuíveis em massa.
     *
     * @var list<string>
     */
    protected $fillable = [
        'uuid',
        'name',
        'slug',
        'domain',
        'database',
        'is_active',
        'metadata',
    ];

    /**
     * Conversões de tipos primitivas.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'metadata' => 'array',
        ];
    }

    /**
     * Usuários vinculados ao tenant.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
