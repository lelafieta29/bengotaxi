<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passageiro extends Model
{
    use HasFactory;

    protected $fillable = ['telefone', 'nascimento', 'rg', 'user_id'];
    protected $table = 'passageiros';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function locaisFavoritos()
    {
        return $this->hasMany(LocaisFavoritos::class);
    }

    public function solicitacoes()
    {
        return $this->hasMany(Solicitacao::class);
    }
}
