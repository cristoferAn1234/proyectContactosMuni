<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    protected $table = 'tipos';
    protected $fillable = [
        'nombre'
    ];

    public function organizaciones()
    {
        return $this->hasMany(Organizacion::class, 'tipo_id');
    }
}
