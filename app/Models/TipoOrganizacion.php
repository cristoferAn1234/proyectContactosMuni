<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoOrganizacion extends Model
{
    protected $table = 'tiposOrganizacion';
    protected $fillable = [
        'nombre'
    ];

    public function organizaciones()
    {
        return $this->hasMany(Organizacion::class, 'tipo_id');
    }
}
