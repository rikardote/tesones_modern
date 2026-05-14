<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Workplace extends Model
{
    use HasFactory;

    protected $fillable = [
        'adscripcion',
        'unidad',
        'lugar',
        'titular_area',
        'pagador_habilitado',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
