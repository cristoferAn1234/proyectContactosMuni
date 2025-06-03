<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    protected $table = 'provincias';

    protected $fillable = [
        'nombre' ];

    public function municipalidades()
    {
        return $this->hasMany(Municipalidad::class, 'id_provincia');
    }
}
