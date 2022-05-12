<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'nome', 'email', 'password', 'activo', 'perfil', 'telefone'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function localizacao()
    {
        return $this->hasOne(Localizacao::class);
    }

    public function passageiro()
    {
        return $this->hasOne(Passageiro::class);
    }

    public function motorista()
    {
        return $this->hasOne(Motorista::class);
    }

    public function empresaTransportes()
    {
        return $this->hasOne(EmpresaTransporte::class);
    }

    public function perfil()
    {
        return $this->hasOne(Perfil::class);
    }

    public function avaliacoes()
    {
        return $this->hasMany(Avaliacao::class);
    }
}
