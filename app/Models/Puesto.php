<?php

namespace App\Models;
use App\Models\Municipalidad;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Puesto extends Model
{
    use HasFactory;
    protected $table = 'puestos';
    protected $fillable = ['nombrePuesto'];

    public function contactos()
    {
        return $this->hasMany(Contacto::class);
    }
}

