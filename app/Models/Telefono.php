<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Telefono extends Model
{
    protected $table = 'telefonos';
    protected $fillable = ['id_Contacto', 'numero', 'tipo'];
    
    public function contacto(){
        return $this ->belongsTo(Contacto::class, 'id_Contacto', 'id');

    }
}
