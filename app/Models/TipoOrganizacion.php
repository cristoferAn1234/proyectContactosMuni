<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TipoOrganizacion extends Model
{
    use HasFactory;
    protected $table = 'tiposOrganizacion';
    protected $fillable = [
        'nombre'
    ];

    public function organizaciones()
    {
        return $this->hasMany(Organizacion::class, 'tipo_id');
    }
}
