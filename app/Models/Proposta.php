<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposta extends Model
{
    use HasFactory;

    protected $fillable = ['confirmacao_passageiro', 'confirmacao_motorista', 'solicitacao_id', 'viagem_id'];
    protected $table = 'propostas';

    public function solicitacao()
    {
        return $this->belongsTo(Solicitacao::class);
    }

    public function viagem()
    {
        return $this->belongsTo(Viagem::class);
    }

    public function passageiros()
    {
        return $this->belongsTo(Viagem::class);
    }

    public function avaliacoes()
    {
        return $this->hasMany(Avaliacao::class);
    }
}
