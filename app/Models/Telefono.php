<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Telefono extends Model
{
    protected $table = 'telefonos';
    protected $fillable = ['contacto_id', 'numero', 'tipo'];
    
    public function contacto(){
        return $this->belongsTo(Contacto::class);
    }
}
