<?php

namespace App\Models;
use App\Models\Municipalidad;

use Illuminate\Database\Eloquent\Model;

class Puesto extends Model
{
    protected $table = 'puestos';
    protected $fillable = ['nombrePuesto'];

    public function contactos()
    {
        return $this->hasMany(Contacto::class);
    }
}

