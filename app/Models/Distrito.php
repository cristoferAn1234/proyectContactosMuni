<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{
    protected $table = 'distritos';

    protected $fillable = [
        'nombre', 'canton_id'
    ];

    public function canton()
    {
        return $this->belongsTo(Canton::class);
    }
    public function organizaciones()
    {
        return $this->hasMany(Organizacion::class);
    }
}
