<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Factories\HasFactory;
class Organizacion extends Model
{
 use HasFactory;
 protected $table = 'organizaciones';
 protected $fillable = [
        'ced_juridica',
        'nombre',
        'tipo_id', // Relaciona con el modelo Tipo
        'telefono',
        'correo',
        'urlPageWeb',
        'provincia_id',// Relaciona con el modelo Provincia
        'canton_id', // Relaciona con el modelo Canton
        'distrito_id', // Relaciona con el modelo Distrito
        'ubi_lat',
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
        return $this->belongsTo(TipoOrganizacion::class,'tipo_id');
    }
    public function provincia()
    {
        return $this->belongsTo(Provincia::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function distrito()
    {
        return $this->belongsTo(Distrito::class);
    }
    public function canton()
    {
        return $this->belongsTo(Canton::class);
    }
}
