<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'usuarios';

    protected $fillable = [
        'nome',
        'email',
        'password',
        'telefone',
        'data_nascimento',
        'tipo',
        'ativo',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'data_nascimento'   => 'date',
        'ativo'             => 'boolean',
        'password'          => 'hashed',
    ];

    // Relações
    public function entradasDiario()
    {
        return $this->hasMany(EntradaDiario::class, 'usuario_id');
    }

    // Helpers
    public function isAdmin(): bool
    {
        return $this->tipo === 'admin';
    }

    public function getAvatarUrlAttribute(): string
    {
        return $this->avatar
            ? asset('storage/' . $this->avatar)
            : asset('img/avatar-default.png');
    }
}
