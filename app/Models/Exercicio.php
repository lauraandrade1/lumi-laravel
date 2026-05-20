<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercicio extends Model
{
    use HasFactory;

    protected $table = 'exercicios';

    protected $fillable = [
        'titulo', 'descricao', 'categoria', 'duracao_minutos',
        'icone', 'ativo', 'ordem', 'passos',
    ];

    protected $casts = [
        'ativo'  => 'boolean',
        'passos' => 'array',
    ];

    public function scopeAtivos($query)
    {
        return $query->where('ativo', true)->orderBy('ordem');
    }
}
