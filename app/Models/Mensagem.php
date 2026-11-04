<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mensagem extends Model
{
    protected $table    = 'mensagens'; // ← corrige pluralização automática

    protected $fillable = ['chat_id','remetente_id','remetente_tipo','conteudo','lida'];
    protected $casts    = ['lida'=>'boolean'];

    public function chat() { return $this->belongsTo(Chat::class); }

    public function getRemetenteNomeAttribute(): string {
        $model = match($this->remetente_tipo) {
            'psicologo' => Psicologo::find($this->remetente_id),
            'estudante' => Estudante::find($this->remetente_id),
            default     => Usuario::find($this->remetente_id),
        };
        return $model?->nome ?? 'Usuário';
    }

    public function getRemetenteFotoAttribute(): string {
        $model = match($this->remetente_tipo) {
            'psicologo' => Psicologo::find($this->remetente_id),
            'estudante' => Estudante::find($this->remetente_id),
            default     => Usuario::find($this->remetente_id),
        };
        return $model?->foto_url ?? asset('img/avatar-default.png');
    }
}