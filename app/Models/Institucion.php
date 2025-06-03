<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    protected  $table = 'instituciones';
    protected $fillable =  ['nombre'];
   public function contactos()
    {
        return $this->hasMany(Contacto::class, 'id_institucion', 'id');
    }

 
}

