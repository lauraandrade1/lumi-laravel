<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Estudante extends Authenticatable
{
    use Notifiable;
    protected $table = 'estudantes';
    protected $fillable = [
        'nome','email','password','telefone','instituicao',
        'semestre','area_estudo','bio','foto','modalidade',
        'cidade','estado','status','ativo',
    ];
    protected $hidden = ['password','remember_token'];
    protected $casts  = ['ativo'=>'boolean','password'=>'hashed'];

    public function isPendente(): bool  { return $this->status === 'pendente'; }
    public function isAprovado(): bool  { return $this->status === 'aprovado'; }
    public function isRejeitado(): bool { return $this->status === 'rejeitado'; }

    public function getFotoUrlAttribute(): string {
        return $this->foto
            ? asset('storage/'.$this->foto)
            : asset('img/avatar-psicologo.png');
    }

    public function scopeAprovados($q) {
        return $q->where('status','aprovado')->where('ativo',true);
    }
}
