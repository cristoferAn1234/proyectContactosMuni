<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    protected $table = 'provincias';

    protected $fillable = [
        'nombre' ];

    


    public function organizaciones()
    {
        return $this->hasMany(Organizacion::class);
    }

}