<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    use HasFactory;
    public function partidas(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Partidas::class);
    }
}
