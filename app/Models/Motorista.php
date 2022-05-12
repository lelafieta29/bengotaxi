<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motorista extends Model
{
    use HasFactory;

    protected $fillable = ['bi', 'telefone', 'nascimento', 'carta_conducao', 'user_id', 'distrito_id', 'empresa_transportes_id'];
    protected $table = 'motoristas';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function empresa_transportes()
    {
        return $this->belongsTo(EmpresaTransporte::class);
    }

    public function distrito()
    {
        //return $this->belongsToMany(Viagem::class);
        return $this->belongsTo(Distrito::class);
    }

    public function viagens()
    {
        //return $this->belongsToMany(Viagem::class);
        return $this->hasMany(Viagem::class);
    }
}
