<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'descricao', 'cor', 'placa', 'ultima_revisao', 'ano', 'capacidade', 'empresa_transportes_id'];
    protected $table = 'veiculos';

    public function empresa_transportes()
    {
        return $this->belongsTo(EmpresaTransporte::class);
    }

    public function viagens()
    {
        return $this->belongsToMany(Viagem::class);
    }
}
