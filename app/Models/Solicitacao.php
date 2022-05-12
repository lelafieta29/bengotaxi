<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitacao extends Model
{
    use HasFactory;

    protected $fillable = ['hora', 'passageiro_id', 'endereco_origem_id', 'endereco_destino_id'];

    protected $table = 'solicitacoes';

    public function passageiro()
    {
        return $this->belongsTo(Passageiro::class);
    }

    public function endereco_origem()
    {
        return $this->belongsTo(Endereco::class);
    }

    public function endereco_destino()
    {
        return $this->belongsTo(Endereco::class);
    }

    public function propostas()
    {
        return $this->hasMany(Proposta::class);
    }
}
