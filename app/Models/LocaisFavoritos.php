<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocaisFavoritos extends Model
{
    use HasFactory;

    protected $fillable = ['passgeiro_id', 'locais_favoritos', 'local_id'];
    protected $table = 'locais_favoritos';

    public function passageiro()
    {
        return $this->belongsTo(Passageiro::class);
    }

    public function posicao()
    {
        return $this->belongsTo(Posicao::class);
    }

    public function local()
    {
        return $this->belognsTo(Local::class);
    }
}
