<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    use HasFactory;

    protected $fillable = ['nota', 'descricao', 'proposta_id', 'motorista_id', 'user_id', 'problema_qualidade_veiculo', 'problema_tempo_chegada', 'problema_rota', 'problema_direccao', 'problema_pagamento', 'problema_ausencia'];

    protected $table = 'avaliacoes';

    public function proposta()
    {
        return $this->belongsTo(Proposta::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function motorista()
    {
        return $this->belongsTo(Motorista::class);
    }
}
