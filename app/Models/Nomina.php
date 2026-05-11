<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nomina extends Model
{
    public $timestamps = false;

    protected $fillable = ['fecha_emision', 'nomina', 'comentario'];

    protected function casts(): array
    {
        return [
            'fecha_emision' => 'date',
        ];
    }

    public function tesones(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Teson::class);
    }

    public function getFullnominaAttribute(): string
    {
        return \Carbon\Carbon::parse($this->fecha_emision)->format('d/m/Y') . ' - ' . $this->nomina;
    }
}
