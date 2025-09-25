<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Canton;

class Provincia extends Model
{
    protected $table = 'provincias';

    protected $fillable = [
        'nombre'
    ];

    public function organizaciones()
    {
        return $this->hasMany(Organizacion::class);
    }
    public function cantones()
    {
        return $this->hasMany(Canton::class);
    }

}