<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntradaDiario extends Model
{
    use HasFactory;

    protected $table = 'entradas_diario';

    protected $fillable = [
        'usuario_id',
        'nivel_humor',
        'conteudo',
        'emocoes_tags',
    ];

    protected $casts = [
        'emocoes_tags' => 'array',
        'nivel_humor'  => 'integer',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function getHumorLabelAttribute(): string
    {
        return match($this->nivel_humor) {
            1 => 'Muito Triste 😢',
            2 => 'Triste 😕',
            3 => 'Neutro 😐',
            4 => 'Feliz 😊',
            5 => 'Muito Feliz 😄',
            default => 'Desconhecido',
        };
    }

    public function getHumorColorAttribute(): string
    {
        return match($this->nivel_humor) {
            1 => '#ef4444',
            2 => '#f97316',
            3 => '#eab308',
            4 => '#22c55e',
            5 => '#8b5cf6',
            default => '#6b7280',
        };
    }
}
