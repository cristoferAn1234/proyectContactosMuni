<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Distrito extends Model
{
    use HasFactory;
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
