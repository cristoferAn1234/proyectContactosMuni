<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    protected $table = 'contactos';
    protected $fillable = [
        'nombre',
        'apellido',
        'apellido2',
        'sexo',
        'puesto',
        'departamento',
        'formacion',
        'extension',
        'email_institucional',
        'email_personal',
        'activo',
        'nivel_contacto',
        'created_by',
        'updated_by',
        'id_municipalidad',
        'id_institucion'
    ];

    public function  municipalidad()
    {
        return $this->belongsTo(Municipalidad::class, 'id_municipalidad', 'id');
    }
    public function institucion()
    {
        return $this->belongsTo(Institucion::class, 'id_institucion', 'id');
    }
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
