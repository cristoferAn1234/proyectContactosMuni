<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    protected $table = 'contactos';
    protected $fillable = [
        'nombre',
        'apellido1',
        'apellido2',
        'sexo',
        'puesto',
        'puesto_id',
        'departamento',
        'formacion',
        'extension',
        'email_institucional',
        'organizacion_id',
        'activo',
        'nivel_contacto',
        'created_by',
        'updated_by',
    ];

    public function organizacion()
    {
        return $this->belongsTo(Organizacion::class);
    }
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
    public function puesto()
    {
        return $this->belongsTo(Puesto::class);
    }
    public function telefonos()
    {
        return $this->hasMany(Telefono::class);
    }
}
