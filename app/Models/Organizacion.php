<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organizacion extends Model
{
 protected $table = 'organizaciones';
 protected $fillable = [
        'ced_juridica',
        'nombre',
        'tipo_id', // Relaciona con el modelo Tipo
        'telefono',
        'correo',
        'urlPageWeb',
        'provincia_id',// Relaciona con el modelo Provincia
        'ubi_Lat',
        'ubi_long',
        'urlDirectorioTelefonico',
        'user_id', // Relaciona con el modelo User
        
    ];

    public function contactos()
    {
        return $this->hasMany(Contacto::class);
    }
// define la relacion en el modelo tipo 
    public function tipo()
    {
        return $this->belongsTo(Tipo::class,'tipo_id');
    }
    public function provincia()
    {
        return $this->belongsTo(Provincia::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
