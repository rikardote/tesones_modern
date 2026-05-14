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
        'lugar', 'titular_area', 'pagador_habilitado', 'type', 'avatar',
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

    public static function avatarIcons(): array
    {
        return [
            'av-1' => ['name' => 'Usuario', 'bg' => 'bg-slate-100', 'svg' => '<svg fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>'],
            'av-2' => ['name' => 'Equipo', 'bg' => 'bg-blue-100', 'svg' => '<svg fill="currentColor" viewBox="0 0 24 24"><path d="M12,12c-2.2,0-4,1.8-4,4s1.8,4,4,4s4-1.8,4-4S14.2,12,12,12z M12,18c-1.1,0-2-0.9-2-2s0.9-2,2-2s2,0.9,2,2 S13.1,18,12,18z M20,4l-4,4c-1.2-0.6-2.5-1-4-1S8.2,7.4,7,8L3,4v8c0,4.4,3.6,8,8,8s8-3.58 8-8V4z"/></svg>'],
            'av-3' => ['name' => 'Oficina', 'bg' => 'bg-indigo-100', 'svg' => '<svg fill="currentColor" viewBox="0 0 24 24"><path d="M20 18c1.1 0 1.99-.9 1.99-2L22 6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2H0v2h24v-2h-4zM4 6h16v10H4V6z"/></svg>'],
            'av-4' => ['name' => 'Seguridad', 'bg' => 'bg-emerald-100', 'svg' => '<svg fill="currentColor" viewBox="0 0 24 24"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 10.99h7c-.53 4.12-3.28 7.79-7 8.94V12H5V6.3l7-3.11v8.8z"/></svg>'],
            'av-5' => ['name' => 'Soporte', 'bg' => 'bg-amber-100', 'svg' => '<svg fill="currentColor" viewBox="0 0 24 24"><path d="M12 2c-4.97 0-9 4.03-9 9v7c0 1.66 1.34 3 3 3h3v-8H5v-2c0-3.87 3.13-7 7-7s7 3.13 7 7v2h-4v8h3c1.66 0 3-1.34 3-3v-7c0-4.97-4.03-9-9-9z"/></svg>'],
            'av-6' => ['name' => 'Investigación', 'bg' => 'bg-rose-100', 'svg' => '<svg fill="currentColor" viewBox="0 0 24 24"><path d="M20.8 18.4l-5-7c-.1-.1-.1-.2-.1-.3V5h1V3H7v2h1v6.1c0 .1 0 .2-.1.3l-5 7c-.3.5-.1 1.2.4 1.5.2.1.3.1.5.1h16c.6 0 1-.4 1-1 0-.2 0-.4-.1-.6zM9.5 14l1.8-2.5V5h1.4v6.5l1.8 2.5H9.5z"/></svg>'],
            'av-7' => ['name' => 'Configuración', 'bg' => 'bg-violet-100', 'svg' => '<svg fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-5-9h10v2H7z"/></svg>'],
            'av-8' => ['name' => 'Compañero', 'bg' => 'bg-cyan-200', 'svg' => '<svg fill="currentColor" viewBox="0 0 24 24"><path d="M12 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/><path d="M5 8c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm14 0c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/></svg>'],
            'av-9' => ['name' => 'Estrella', 'bg' => 'bg-fuchsia-100', 'svg' => '<svg fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>'],
            'av-10' => ['name' => 'Fuego', 'bg' => 'bg-orange-100', 'svg' => '<svg fill="currentColor" viewBox="0 0 24 24"><path d="M13.5.67s.74 2.65.74 4.8c0 2.06-1.35 3.73-3.41 3.73-2.07 0-3.63-1.67-3.63-3.73l.03-.36C5.21 7.51 4 10.62 4 14c0 4.42 3.58 8 8 8s8-3.58 8-8c0-5.33-4.5-9.33-4.5-13.33zM12 19c-2.76 0-5-2.24-5-5 0-1.72 1.34-3.15 3.12-4.08.62-.32 1.27-.58 1.91-.77.16 1.25.75 2.41 1.63 3.32.74.78 1.34 1.68 1.34 2.53 0 2.21-1.79 4-4 4z"/></svg>'],
            'av-11' => ['name' => 'Rayo', 'bg' => 'bg-yellow-100', 'svg' => '<svg fill="currentColor" viewBox="0 0 24 24"><path d="M7 2v11h3v9l7-12h-4l4-8z"/></svg>'],
            'av-12' => ['name' => 'Mundo', 'bg' => 'bg-teal-100', 'svg' => '<svg fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1.0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/></svg>'],
        ];
    }

    public function getAvatarData(): array
    {
        return self::avatarIcons()[$this->avatar] ?? self::avatarIcons()['av-1'];
    }

    public function workplaces(): BelongsToMany
    {
        return $this->belongsToMany(Workplace::class);
    }
}
