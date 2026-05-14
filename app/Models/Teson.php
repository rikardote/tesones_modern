<?php

namespace App\Models;

use App\Enums\FormaPago;
use App\Enums\TipoPersonal;
use Illuminate\Database\Eloquent\Model;

class Teson extends Model
{
    protected $fillable = [
        'user_id', 'remision_nomina', 'tipo_personal', 'nomina_id',
        'folio_inicial', 'folio_final', 'fecha_elaboracion', 'observaciones',
        'adscripcion_snapshot', 'unidad_snapshot', 'lugar_snapshot',
        'titular_area_snapshot', 'pagador_habilitado_snapshot',
        'workplace_id',
    ];

    protected function casts(): array
    {
        return [
            'fecha_elaboracion' => 'date',
            'remision_nomina' => 'integer',
            'tipo_personal' => 'integer',
            'folio_inicial' => 'integer',
            'folio_final' => 'integer',
        ];
    }

    public function nomina(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Nomina::class);
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function cancelaciones(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Cancelacion::class);
    }

    public function workplace(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Workplace::class);
    }

    public function getFormaPagoLabelAttribute(): string
    {
        return FormaPago::tryFrom($this->remision_nomina)?->label() ?? 'DESCONOCIDO';
    }

    public function getTipoPersonalLabelAttribute(): string
    {
        return TipoPersonal::tryFrom($this->tipo_personal)?->label() ?? 'DESCONOCIDO';
    }

    public function getFechaEmisionAttribute()
    {
        return $this->nomina?->fecha_emision;
    }
}
