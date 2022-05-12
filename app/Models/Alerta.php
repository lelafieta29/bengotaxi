<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alerta extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'descricao', 'lida', 'tipo', 'user_destinatario_id', 'user_remetente_id'];

    public function user_destinatario()
    {
        return $this->belongsTo(User::class);
    }

    public function user_remetente()
    {
        return $this->belongsTo(User::class);
    }
}
