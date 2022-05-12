<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Viagem extends Model
{
    use HasFactory;

    protected $fillable = ['tipo_viagem', 'status', 'situacao', 'origem', 'destino', 'valor', 'vagas', 'motorista_id', 'veiculo_id', 'hora_inicio', 'endereco_origem_id', 'endereco_destino_id'];

    protected $table = 'viagens';

    public function motorista()
    {
        return $this->belongsTo(Motorista::class);
    }

    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class);
    }

    public function propostas()
    {
        return $this->hasMany(Proposta::class);
    }

    public function endereco_origem()
    {
        return $this->belongsTo(Endereco::class);
    }

    public function endereco_destino()
    {
        return $this->belongsTo(Endereco::class);
    }
}
