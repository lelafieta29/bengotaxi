<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = ['tipo', 'descricao', 'user_id'];

    public function feedback()
    {
        return $this->belongsTo(User::class);
    }
}
