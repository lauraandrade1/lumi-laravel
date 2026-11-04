<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = ['usuario_id','destinatario_id','destinatario_tipo'];

    public function usuario()    { return $this->belongsTo(Usuario::class,'usuario_id'); }
    public function mensagens()  { return $this->hasMany(Mensagem::class,'chat_id')->orderBy('created_at'); }
    public function ultimaMensagem() { return $this->hasOne(Mensagem::class,'chat_id')->latestOfMany(); }

    public function getDestinatarioAttribute() {
        if ($this->destinatario_tipo === 'psicologo')
            return Psicologo::find($this->destinatario_id);
        return Estudante::find($this->destinatario_id);
    }
}
