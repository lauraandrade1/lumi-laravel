<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $table = 'materiais';

    protected $fillable = [
        'titulo', 'descricao', 'tipo', 'url', 'arquivo', 'thumbnail', 'ativo', 'visualizacoes',
    ];

    protected $casts = [
        'ativo' => 'boolean',
    ];

    public function scopeAtivos($query)
    {
        return $query->where('ativo', true);
    }

    public function getTipoLabelAttribute(): string
    {
        return match($this->tipo) {
            'artigo'   => 'Artigo',
            'video'    => 'Vídeo',
            'workbook' => 'Workbook',
            'podcast'  => 'Podcast',
            default    => ucfirst($this->tipo),
        };
    }

    public function getTipoIconeAttribute(): string
    {
        return match($this->tipo) {
            'artigo'   => 'fa-newspaper',
            'video'    => 'fa-play-circle',
            'workbook' => 'fa-file-pdf',
            'podcast'  => 'fa-headphones',
            default    => 'fa-file',
        };
    }
}
