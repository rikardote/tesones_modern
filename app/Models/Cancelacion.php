<?php

namespace App\Models;

use App\Enums\ClaveCancelacion;
use Illuminate\Database\Eloquent\Model;

class Cancelacion extends Model
{
    protected $table = 'cancelaciones';

    protected $fillable = [
        'num_empleado', 'nombre', 'numero_cheque', 'importe', 'clave',
    ];

    protected function casts(): array
    {
        return [
            'importe' => 'decimal:2',
            'num_empleado' => 'integer',
            'numero_cheque' => 'integer',
            'clave' => 'integer',
        ];
    }

    public function teson(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Teson::class);
    }

    public function getClaveLabelAttribute(): string
    {
        return ClaveCancelacion::tryFrom($this->clave)?->label() ?? 'DESCONOCIDO';
    }
}
