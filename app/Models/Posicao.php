<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posicao extends Model
{
    use HasFactory;

    protected $fillable = ['latitude', 'longitudo'];
    protected $table = 'posicoes';

    public function solicitadoes()
    {
        return $this->hasMany(Solicitacao::class);
    }

    public function locaisFavoritos()
    {
        return $this->hasMany(LocaisFavoritos::class);
    }
}
