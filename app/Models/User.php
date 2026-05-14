<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'adscripcion', 'unidad',
        'lugar', 'titular_area', 'pagador_habilitado', 'type',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->type === 'admin';
    }

    public function tesones(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Teson::class);
    }

    public function workplaces(): BelongsToMany
    {
        return $this->belongsToMany(Workplace::class);
    }
}
