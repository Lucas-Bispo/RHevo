<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventoEsocial extends Model
{
    use HasFactory;

    protected $table = 'eventos_esocial';

    protected $fillable = [
        'tenant_id',
        'servidor_id',
        'evento',
        'status',
        'ambiente',
        'payload',
        'recibo',
        'protocolo',
        'mensagem_retorno',
        'enviado_em',
        'processado_em',
    ];

    protected function casts(): array
    {
        return [
            'payload' => 'array',
            'enviado_em' => 'datetime',
            'processado_em' => 'datetime',
        ];
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function servidor(): BelongsTo
    {
        return $this->belongsTo(Servidor::class);
    }
}
