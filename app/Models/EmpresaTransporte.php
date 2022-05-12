<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpresaTransporte extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'descricao', 'user_id', 'nif'];

    protected $table = 'empresas_transportes';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function motoristas()
    {
        return $this->hasMany(Motorista::class);
    }

    public function veiculos()
    {
        return $this->hasMany(Veiculo::class);
    }
}
