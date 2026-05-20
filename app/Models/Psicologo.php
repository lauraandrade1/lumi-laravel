<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Psicologo extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'psicologos';

    protected $fillable = [
        'nome',
        'email',
        'password',
        'crp',
        'telefone',
        'especialidade',
        'bio',
        'foto',
        'valor_consulta',
        'modalidade',
        'cidade',
        'estado',
        'status',
        'ativo',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'ativo'           => 'boolean',
        'valor_consulta'  => 'decimal:2',
        'avaliacao_media' => 'decimal:2',
        'password'        => 'hashed',
    ];

    // Scopes
    public function scopeAprovados($query)
    {
        return $query->where('status', 'aprovado')->where('ativo', true);
    }

    public function scopePendentes($query)
    {
        return $query->where('status', 'pendente');
    }

    // Helpers
    public function isPendente(): bool   { return $this->status === 'pendente'; }
    public function isAprovado(): bool   { return $this->status === 'aprovado'; }
    public function isRejeitado(): bool  { return $this->status === 'rejeitado'; }

    public function getFotoUrlAttribute(): string
    {
        return $this->foto
            ? asset('storage/' . $this->foto)
            : asset('img/avatar-psicologo.png');
    }

    /**
     * Formata CRP para exibição: "SP/12345"
     */
    public function getCrpFormatadoAttribute(): string
    {
        return strtoupper($this->crp);
    }

    /**
     * Valida formato do CRP: UF/NNNNN (ex: SP/12345, 06/12345)
     */
    public static function validarFormatoCrp(string $crp): bool
    {
        return (bool) preg_match('/^[A-Z0-9]{2}\/\d{4,6}$/i', $crp);
    }
}
